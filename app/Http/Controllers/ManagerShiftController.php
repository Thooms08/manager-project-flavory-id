<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{KategoriShift, MemberShift, JadwalShift, Karyawan, Manager};
use Illuminate\Support\Facades\{Auth, DB};
use Carbon\Carbon;

class ManagerShiftController extends Controller
{
    private function getManagerId() {
        return Manager::where('user_id', Auth::id())->value('id');
    }

    public function index()
    {
        $shifts = KategoriShift::withCount('members')->where('manager_id', $this->getManagerId())->get();
        return view('manager.shift', compact('shifts'));
    }

    public function storeKategori(Request $request)
    {
        $request->validate(['shift' => 'required|string|max:255']);
        
        KategoriShift::create([
            'manager_id' => $this->getManagerId(),
            'shift' => strtoupper($request->shift)
        ]);

        return redirect()->back()->with('success', 'Kategori Shift berhasil ditambahkan.');
    }

    public function detail($uuid)
    {
        // Eager load seluruh relasi yang dibutuhkan, termasuk jadwal dari shift LAIN milik karyawan tersebut
        $shift = KategoriShift::with([
            'members.karyawan.memberShifts.jadwals', 
            'members.jadwals'
        ])->where('uuid', $uuid)->firstOrFail();
        
        $existingKaryawanIds = $shift->members->pluck('karyawan_id')->toArray();
        
        $karyawans = Karyawan::where('manager_id', $this->getManagerId())
            ->where('status', 'aktif')
            ->whereNotIn('id', $existingKaryawanIds)
            ->get();

        return view('manager.shift-detail', compact('shift', 'karyawans'));
    }

    public function addKaryawan(Request $request, $uuid)
    {
        $request->validate(['karyawan_id' => 'required|exists:karyawans,id']);
        $shift = KategoriShift::where('uuid', $uuid)->firstOrFail();

        MemberShift::create([
            'karyawan_id' => $request->karyawan_id,
            'kategori_id' => $shift->id
        ]);

        return redirect()->back()->with('success', 'Karyawan berhasil ditambahkan ke shift.');
    }

    public function destroyMember($uuid)
    {
        $member = MemberShift::where('uuid', $uuid)->firstOrFail();
        $member->delete();
        return redirect()->back()->with('success', 'Karyawan dihapus dari shift.');
    }

    public function storeJadwal(Request $request)
    {
        $request->validate([
            'member_uuid' => 'required|exists:member_shifts,uuid',
            'bulan_tahun' => 'required|date_format:Y-m',
            'jam_masuk' => 'required_with:tgl_masuk|date_format:H:i',
            'jam_keluar' => 'required_with:tgl_masuk|date_format:H:i',
            'absen_awal' => 'required_with:tgl_masuk|date_format:H:i',
            'absen_akhir' => 'required_with:tgl_masuk|date_format:H:i',
            'tgl_masuk' => 'nullable|array',
            'tgl_libur' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();
            $member = MemberShift::where('uuid', $request->member_uuid)->firstOrFail();
            $karyawan_id = $member->karyawan_id;
            $bulanTahun = $request->bulan_tahun;

            $datesToProcess = array_merge($request->tgl_masuk ?? [], $request->tgl_libur ?? []);
            
            // 1. VALIDASI BACKEND: Pastikan Karyawan ini tidak punya jadwal di shift LAIN pada tanggal yang dipilih
            if (!empty($datesToProcess)) {
                $bentrok = JadwalShift::whereHas('member', function($q) use ($karyawan_id) {
                        $q->where('karyawan_id', $karyawan_id);
                    })
                    ->where(function($q) use ($datesToProcess) {
                        $q->whereIn('tgl_masuk', $datesToProcess)
                          ->orWhereIn('tgl_libur', $datesToProcess);
                    })
                    ->where('member_id', '!=', $member->id) // Abaikan jadwal dari shift ini sendiri (karena sedang diedit)
                    ->exists();

                if ($bentrok) {
                    return redirect()->back()->with('error', 'Gagal: Karyawan ini sudah ditugaskan pada shift lain di salah satu tanggal yang dipilih!');
                }
            }

            // 2. HAPUS jadwal lama HANYA untuk bulan yang sedang diedit (agar bisa sinkronisasi fitur "Clear")
            JadwalShift::where('member_id', $member->id)
                ->where(function($q) use ($bulanTahun) {
                    $q->where('tgl_masuk', 'like', $bulanTahun . '-%')
                      ->orWhere('tgl_libur', 'like', $bulanTahun . '-%');
                })->delete();

            // 3. INSERT Tgl Masuk
            if ($request->filled('tgl_masuk')) {
                $masukData = [];
                foreach ($request->tgl_masuk as $date) {
                    $masukData[] = [
                        'member_id' => $member->id,
                        'tgl_masuk' => $date,
                        'tgl_libur' => null,
                        'jam_masuk' => $request->jam_masuk,
                        'jam_keluar' => $request->jam_keluar,
                        'absen_awal' => $request->absen_awal,
                        'absen_akhir' => $request->absen_akhir,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                JadwalShift::insert($masukData);
            }

            // 4. INSERT Tgl Libur
            if ($request->filled('tgl_libur')) {
                $liburData = [];
                foreach ($request->tgl_libur as $date) {
                    $liburData[] = [
                        'member_id' => $member->id,
                        'tgl_masuk' => null,
                        'tgl_libur' => $date,
                        'jam_masuk' => null, 'jam_keluar' => null,
                        'absen_awal' => null, 'absen_akhir' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                JadwalShift::insert($liburData);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Jadwal shift bulan ' . date('F Y', strtotime($bulanTahun)) . ' berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}