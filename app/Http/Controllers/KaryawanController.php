<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\JadwalShift;
use App\Models\AbsensiKaryawan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class KaryawanController extends Controller
{
    /**
     * Helper Fungsi untuk Cek Validitas Waktu Absen (Termasuk Lintas Hari)
     */
    private function cekBatasWaktu($jamMasuk, $jamKeluar) {
        $nowTime = Carbon::now()->format('H:i');
        $start = Carbon::parse($jamMasuk)->format('H:i');
        $end = Carbon::parse($jamKeluar)->format('H:i');

        if ($start > $end) {
            // Kondisi Lintas Hari (Contoh: 07:00 - 00:26)
            return ($nowTime >= $start || $nowTime <= $end);
        } else {
            // Kondisi Normal / Hari Sama (Contoh: 07:00 - 15:00)
            return ($nowTime >= $start && $nowTime <= $end);
        }
    }

    /**
     * Helper Fungsi untuk menyimpan gambar base64
     */
    private function simpanFotoBase64($base64String, $folderName)
    {
        // JIKA KAMERA DIMATIKAN, FOTO KOSONG, MAKA LANGSUNG KEMBALIKAN NULL
        if (empty($base64String)) {
            return null;
        }

        // Pisahkan format mime dan base64 datanya
        $image_parts = explode(";base64,", $base64String);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        // Buat nama file unik (timestamp + uuid)
        $fileName = \Carbon\Carbon::now()->timestamp . '_' . \Illuminate\Support\Str::uuid() . '.' . $image_type;
        $path = base_path('assets/' . $folderName);

        // Buat folder jika belum ada
        if (!\Illuminate\Support\Facades\File::exists($path)) {
            \Illuminate\Support\Facades\File::makeDirectory($path, 0755, true);
        }

        // Simpan file
        \Illuminate\Support\Facades\File::put($path . '/' . $fileName, $image_base64);

        // Return path untuk disimpan ke DB
        return 'assets/' . $folderName . '/' . $fileName;
    }

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

        // 2. Logika Mangkir Otomatis
        $jadwalTerlewat = JadwalShift::whereHas('member', function ($query) use ($karyawan) {
                $query->where('karyawan_id', $karyawan->id);
            })
            ->where('tgl_masuk', '<', $hariIni)
            ->whereDoesntHave('absensi') 
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

            // Cek ketersediaan absen berdasarkan rentang absen_awal dan absen_akhir
            if ($jadwalHariIni->absen_awal && $jadwalHariIni->absen_akhir) {
                $isBisaAbsen = $this->cekBatasWaktu($jadwalHariIni->absen_awal, $jadwalHariIni->absen_akhir);
            }
        }

        $pengaturan = \App\Models\PengaturanAbsensi::where('manager_id', $karyawan->manager_id)->first();
        if (!$pengaturan) {
            // Default jika manager belum pernah mensetting sama sekali
            $pengaturan = (object) ['kamera_absen' => true, 'kamera_izin' => true];
        }

        return view('karyawan.index', compact(
            'karyawan', 
            'jadwalHariIni', 
            'absensiHariIni', 
            'isBisaAbsen', 
            'jadwalKalender',
            'pengaturan'
        ));
    }

    /**
     * Proses simpan data absen hadir
     */
    public function storeAbsen(Request $request)
    {
        // 1. Ambil data karyawan & pengaturan
        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();
        $pengaturan = \App\Models\PengaturanAbsensi::where('manager_id', $karyawan->manager_id)->first();
        $kameraDiwajibkan = $pengaturan ? $pengaturan->kamera_absen : true;

        // 2. Lakukan HANYA SATU KALI Validasi (Dinamis)
        $aturanValidasi = ['jadwal_id' => 'required|exists:jadwal_shifts,id'];
        if ($kameraDiwajibkan) {
            $aturanValidasi['foto'] = 'required|string'; // Foto hanya wajib jika ON
        }
        $request->validate($aturanValidasi);

        $jadwal = JadwalShift::findOrFail($request->jadwal_id);

        // Cek duplicate absensi
        $cekAbsen = AbsensiKaryawan::where('karyawan_id', $karyawan->id)
            ->where('jadwal_id', $jadwal->id)
            ->first();

        if ($cekAbsen) {
            return back()->with('error', 'Anda sudah memiliki catatan kehadiran untuk jadwal ini.');
        }

        // Validasi waktu backend
        if (!$this->cekBatasWaktu($jadwal->absen_awal, $jadwal->absen_akhir)) {
            $waktuBuka = \Carbon\Carbon::parse($jadwal->absen_awal)->format('H:i');
            $waktuTutup = \Carbon\Carbon::parse($jadwal->absen_akhir)->format('H:i');
            return back()->with('error', "Gagal absen! Waktu absensi hanya dibuka dari jam $waktuBuka sampai $waktuTutup.");
        }

        try {
            // Proses kompresi & penyimpanan foto (jika kosong, fungsi ini akan mengembalikan null berkat perbaikan sebelumnya)
            $pathFoto = $this->simpanFotoBase64($request->foto, 'absen');
            
            // Simpan Absensi
            AbsensiKaryawan::create([
                'manager_id'  => $karyawan->manager_id ?? 1, 
                'karyawan_id' => $karyawan->id,
                'jadwal_id'   => $jadwal->id,
                'status'      => 'absen',
                'keterangan'  => 'Hadir',
                'foto'        => $pathFoto
            ]);

            return back()->with('success', 'Absensi berhasil dicatat!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses absensi. Coba lagi.');
        }
    }
    /**
     * Proses simpan data pengajuan izin
     */
    public function storeIzin(Request $request)
    {
        // 1. Ambil data karyawan & pengaturan
        $karyawan = Karyawan::where('user_id', Auth::id())->firstOrFail();
        $pengaturan = \App\Models\PengaturanAbsensi::where('manager_id', $karyawan->manager_id)->first();
        $kameraDiwajibkan = $pengaturan ? $pengaturan->kamera_izin : true;

        // 2. Lakukan HANYA SATU KALI Validasi (Dinamis)
        $aturanValidasi = [
            'jadwal_id'  => 'required|exists:jadwal_shifts,id',
            'keterangan' => 'required|string|max:255'
        ];
        if ($kameraDiwajibkan) {
            $aturanValidasi['foto'] = 'required|string'; // Foto hanya wajib jika ON
        }
        $request->validate($aturanValidasi);

        $jadwal = JadwalShift::findOrFail($request->jadwal_id);
        
        // Cek duplicate absensi
        $cekAbsen = AbsensiKaryawan::where('karyawan_id', $karyawan->id)
            ->where('jadwal_id', $jadwal->id)
            ->first();

        if ($cekAbsen) {
            return back()->with('error', 'Anda sudah memiliki catatan kehadiran untuk hari ini. Tidak dapat mengajukan izin.');
        }

       // Validasi waktu backend untuk izin
        if (!$this->cekBatasWaktu($jadwal->absen_awal, $jadwal->absen_akhir)) {
            $waktuBuka = \Carbon\Carbon::parse($jadwal->absen_awal)->format('H:i');
            $waktuTutup = \Carbon\Carbon::parse($jadwal->absen_akhir)->format('H:i');
            return back()->with('error', "Gagal mengajukan izin! Izin hanya dapat diajukan pada batas jam absensi ($waktuBuka - $waktuTutup).");
        }

        try {
            // Proses kompresi & penyimpanan foto
            $pathFoto = $this->simpanFotoBase64($request->foto, 'izin');

            // Simpan Izin
            AbsensiKaryawan::create([
                'manager_id'  => $karyawan->manager_id ?? 1,
                'karyawan_id' => $karyawan->id,
                'jadwal_id'   => $jadwal->id,
                'status'      => 'izin',
                'keterangan'  => $request->keterangan,
                'foto'        => $pathFoto
            ]);

            return back()->with('success', 'Pengajuan izin berhasil dikirim!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses izin. Coba lagi.');
        }
    }
}