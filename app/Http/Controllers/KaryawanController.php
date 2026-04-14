<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\JadwalShift;
use App\Models\AbsensiKaryawan;

class KaryawanController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama karyawan
     */
   public function index()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->id)->first();

        if (!$karyawan) {
            Auth::logout();
            return redirect('/login')->withErrors(['username' => 'Data profil karyawan tidak ditemukan.']);
        }

        $now = Carbon::now();
        $hariIni = $now->toDateString();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // 1. Ambil SEMUA jadwal bulan ini untuk kalender
        $semuaJadwalBulanIni = JadwalShift::with(['member.kategori'])
            ->whereHas('member', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query->whereBetween('tgl_masuk', [$startOfMonth, $endOfMonth])
                      ->orWhereBetween('tgl_libur', [$startOfMonth, $endOfMonth]);
            })
            ->get();

        // Format data untuk kalender (Key: Tanggal, Value: Detail)
        $jadwalKalender = [];
        foreach ($semuaJadwalBulanIni as $j) {
            $tgl = $j->tgl_masuk ?? $j->tgl_libur;
            $jadwalKalender[$tgl] = [
                'is_libur'    => !empty($j->tgl_libur),
                'shift_name'  => $j->member->kategori->shift ?? 'Shift Reguler',
                'jam_masuk'   => $j->jam_masuk ? Carbon::parse($j->jam_masuk)->format('H:i') : '-',
                'jam_keluar'  => $j->jam_keluar ? Carbon::parse($j->jam_keluar)->format('H:i') : '-',
                'absen_awal'  => $j->absen_awal ? Carbon::parse($j->absen_awal)->format('H:i') : '-',
                'absen_akhir' => $j->absen_akhir ? Carbon::parse($j->absen_akhir)->format('H:i') : '-',
            ];
        }

        // 2. Logika Mangkir Otomatis (Tetap dipertahankan)
        $jadwalTerlewat = JadwalShift::whereHas('member', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->where('tgl_masuk', '<', $hariIni)
            ->whereDoesntHave('absensi') // Pastikan relasi absensi ada di model JadwalShift jika ingin efisien
            ->get();

        foreach ($jadwalTerlewat as $jl) {
            AbsensiKaryawan::firstOrCreate([
                'karyawan_id' => $karyawan->id,
                'jadwal_id'   => $jl->id,
            ], [
                'manager_id' => $karyawan->manager_id ?? 1,
                'status'     => 'mangkir',
                'keterangan' => 'Mangkir Otomatis'
            ]);
        }

        // 3. Jadwal Hari Ini & Status Absen
        $jadwalHariIni = JadwalShift::with(['member.kategori'])
            ->whereHas('member', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->where(function ($query) use ($hariIni) {
                $query->where('tgl_masuk', $hariIni)
                      ->orWhere('tgl_libur', $hariIni);
            })->first();

        $absensiHariIni = null;
        $isBisaAbsen = false;

        if ($jadwalHariIni) {
            $absensiHariIni = AbsensiKaryawan::where('karyawan_id', $karyawan->id)
                ->where('jadwal_id', $jadwalHariIni->id)->first();

            if ($jadwalHariIni->jam_masuk && $jadwalHariIni->jam_keluar) {
                $jamMasuk = Carbon::parse($jadwalHariIni->jam_masuk);
                $jamKeluar = Carbon::parse($jadwalHariIni->jam_keluar);
                if ($now->between($jamMasuk, $jamKeluar)) {
                    $isBisaAbsen = true;
                }
            }
        }

        return view('karyawan.index', compact(
            'karyawan', 
            'jadwalHariIni', 
            'absensiHariIni', 
            'isBisaAbsen', 
            'jadwalKalender'
        ));
    }
    /**
     * Proses simpan data absen hadir
     */
    public function storeAbsen(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_shifts,id',
        ]);

        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();
        $jadwal = JadwalShift::findOrFail($request->jadwal_id);
        $now = Carbon::now();

        // Cek duplicate absensi
        $cekAbsen = AbsensiKaryawan::where('karyawan_id', $karyawan->id)
            ->where('jadwal_id', $jadwal->id)
            ->first();

        if ($cekAbsen) {
            return back()->with('error', 'Anda sudah memiliki catatan kehadiran untuk jadwal ini.');
        }

        // Validasi waktu backend (Mencegah bypass inspect element di browser)
        $jamMasuk = Carbon::parse($jadwal->jam_masuk);
        $jamKeluar = Carbon::parse($jadwal->jam_keluar);

        if (!$now->between($jamMasuk, $jamKeluar)) {
            return back()->with('error', 'Gagal absen! Di luar jam absensi operasional.');
        }

        // Simpan Absensi
        AbsensiKaryawan::create([
            'manager_id' => $karyawan->manager_id ?? 1, 
            'karyawan_id' => $karyawan->id,
            'jadwal_id' => $jadwal->id,
            'status' => 'absen',
            'keterangan' => 'Hadir'
        ]);

        return back()->with('success', 'Absensi berhasil dicatat!');
    }

    /**
     * Proses simpan data pengajuan izin
     */
    public function storeIzin(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_shifts,id',
            'keterangan' => 'required|string|max:255',
        ]);

        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();
        
        // Cek duplicate absensi
        $cekAbsen = AbsensiKaryawan::where('karyawan_id', $karyawan->id)
            ->where('jadwal_id', $request->jadwal_id)
            ->first();

        if ($cekAbsen) {
            return back()->with('error', 'Anda sudah memiliki catatan kehadiran untuk hari ini. Tidak dapat mengajukan izin.');
        }

        // Simpan Izin
        AbsensiKaryawan::create([
            'manager_id' => $karyawan->manager_id ?? 1,
            'karyawan_id' => $karyawan->id,
            'jadwal_id' => $request->jadwal_id,
            'status' => 'izin',
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Pengajuan izin berhasil dikirim!');
    }
}