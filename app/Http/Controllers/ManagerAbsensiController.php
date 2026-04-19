<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Karyawan, AbsensiKaryawan, Manager, PengaturanAbsensi};
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;

class ManagerAbsensiController extends Controller
{
    private function getManagerId() {
        return Manager::where('user_id', Auth::id())->value('id');
    }

    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');
        $daysInMonth = Carbon::create($tahun, $bulan)->daysInMonth;
        
        $managerId = $this->getManagerId();

        // Ambil Pengaturan Toggle Kamera (Jika belum ada di DB, otomatis terbuat dan ON)
        $pengaturan = PengaturanAbsensi::firstOrCreate(
            ['manager_id' => $managerId],
            ['kamera_absen' => true, 'kamera_izin' => true]
        );

        // 1. Eager Load Data Karyawan, User, dan Jadwal di bulan terpilih
        $karyawans = Karyawan::with(['user', 'memberShifts.jadwals' => function($q) use ($bulan, $tahun) {
            $q->whereMonth('tgl_masuk', $bulan)->whereYear('tgl_masuk', $tahun)
              ->orWhere(function($q2) use ($bulan, $tahun) {
                  $q2->whereMonth('tgl_libur', $bulan)->whereYear('tgl_libur', $tahun);
              });
        }])->where('manager_id', $managerId)->get();

        // 2. Kumpulkan semua ID Jadwal untuk mencegah N+1 saat memanggil Absensi
        $jadwalIds = $karyawans->flatMap->memberShifts->flatMap->jadwals->pluck('id');
        
        // 3. Ambil Absensi Karyawan
        $absensis = AbsensiKaryawan::whereIn('jadwal_id', $jadwalIds)->get()->keyBy('jadwal_id');

        // 4. Struktur Ulang Data untuk View & Excel
        $dataAbsensi = [];

        foreach ($karyawans as $karyawan) {
            $cal = [];
            $totals = ['absen' => 0, 'mangkir' => 0, 'izin' => 0, 'libur' => 0];

            // Inisialisasi grid bulan
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $cal[$i] = ['status' => 'kosong', 'ket' => '', 'foto' => null];
            }

            // Mapping jadwal ke grid
            foreach ($karyawan->memberShifts as $member) {
                foreach ($member->jadwals as $jadwal) {
                    if ($jadwal->tgl_libur) {
                        $day = (int) date('d', strtotime($jadwal->tgl_libur));
                        $cal[$day] = ['status' => 'libur', 'ket' => '', 'foto' => null];
                        $totals['libur']++;
                    } elseif ($jadwal->tgl_masuk) {
                        $day = (int) date('d', strtotime($jadwal->tgl_masuk));
                        
                        // Cek apakah ada record absensinya
                        if ($absensis->has($jadwal->id)) {
                            $record = $absensis->get($jadwal->id);
                            $keteranganTampil = $record->keterangan;
            
                            if ($record->status === 'absen') {
                                // Mengambil jam saja (H:i) dari waktu absensi dibuat
                                $keteranganTampil = Carbon::parse($record->created_at)->format('H:i');
                            }

                            $cal[$day] = [
                                'status' => $record->status, 
                                'ket' => $keteranganTampil,
                                'foto' => $record->foto ?? null // Menambahkan foto ke respon
                            ];
                            $totals[$record->status]++;
                        } else {
                            // Jika jadwal masuk tapi belum ada data absen (dan tanggal sudah lewat), bisa kita set Mangkir
                            if (Carbon::parse($jadwal->tgl_masuk)->isPast()) {
                                $cal[$day] = ['status' => 'mangkir', 'ket' => 'Tidak ada data masuk', 'foto' => null];
                                $totals['mangkir']++;
                            } else {
                                $cal[$day] = ['status' => 'belum', 'ket' => '', 'foto' => null]; // Hari mendatang
                            }
                        }
                    }
                }
            }

            $dataAbsensi[] = [
                'id' => $karyawan->id,
                'username' => $karyawan->user->username ?? '-',
                'nama' => $karyawan->nama,
                'calendar' => $cal,
                'total_absen' => $totals['absen'],
                'total_mangkir' => $totals['mangkir'],
                'total_izin' => $totals['izin'],
                'total_libur' => $totals['libur'],
            ];
        }

        // Handle Export
        if ($request->has('export') && $request->export == 'excel') {
            $fileName = 'absensi_' . $bulan . '_' . $tahun . '.xlsx';
            return Excel::download(new AbsensiExport($dataAbsensi, $bulan, $tahun, $daysInMonth), $fileName);
        }

        return view('manager.absensi-karyawan', compact('dataAbsensi', 'bulan', 'tahun', 'daysInMonth', 'pengaturan'));
    }

    /**
     * AJAX Method untuk memperbarui status toggle kamera
     */
    public function updateToggle(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:absen,izin',
            'status' => 'required|boolean'
        ]);

        $managerId = $this->getManagerId();
        $pengaturan = PengaturanAbsensi::where('manager_id', $managerId)->first();

        if ($request->jenis == 'absen') {
            $pengaturan->kamera_absen = $request->status;
        } else {
            $pengaturan->kamera_izin = $request->status;
        }

        $pengaturan->save();

        return response()->json([
            'success' => true,
            'message' => 'Pengaturan Kamera ' . ucfirst($request->jenis) . ' berhasil di' . ($request->status ? 'aktifkan' : 'matikan') . '.'
        ]);
    }
}