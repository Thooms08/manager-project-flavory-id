<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ManagerKaryawanController extends Controller
{
    // Asumsi manager_id didapat dari Auth user saat ini. 
    // Sesuaikan logika ini dengan struktur autentikasi Flavory.id Anda.
    private function getManagerId() {
        return Auth::id(); // Ubah ke Auth::user()->manager->id jika tabel terpisah
    }

    public function index() {
        return view('manager.karyawan');
    }

    public function aktif() {
        $karyawans = Karyawan::where('manager_id', $this->getManagerId())
                             ->where('status', 'aktif')->latest()->get();
        return view('manager.karyawan-aktif', compact('karyawans'));
    }

    public function nonaktif() {
        $karyawans = Karyawan::where('manager_id', $this->getManagerId())
                             ->where('status', 'nonaktif')->latest()->get();
        return view('manager.karyawan-nonaktif', compact('karyawans'));
    }

    public function akun() {
        // Karyawan aktif yang belum punya akun
        $karyawans = Karyawan::where('manager_id', $this->getManagerId())
                             ->where('status', 'aktif')->whereNull('user_id')->get();
        // Karyawan yang sudah punya akun
        $akunKaryawans = Karyawan::where('manager_id', $this->getManagerId())
                                 ->whereNotNull('user_id')->with('user')->get();
        
        return view('manager.akun-karyawan', compact('karyawans', 'akunKaryawans'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email|unique:users,email',
            'no_tlp' => 'required|unique:karyawans,no_tlp',
            'tgl_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string',
            'domisili' => 'nullable|string',
            'alamat' => 'nullable|string',
            'tgl_masuk' => 'required|date',
            'jabatan' => 'required|string|max:100', 
            'jenis_karyawan' => 'required|string|max:100', 
            'ktp' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'cv' => 'nuillable|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $data = $request->except(['ktp', 'cv']);
        $data['manager_id'] = $this->getManagerId();
        $data['status'] = 'aktif';

        if ($request->hasFile('ktp')) {
            $data['ktp'] = $this->compressAndUpload($request->file('ktp'), 'assets/ktp', 'ktp');
        }
        if ($request->hasFile('cv')) {
            $data['cv'] = $this->compressAndUpload($request->file('cv'), 'assets/cv', 'cv');
        }

        Karyawan::create($data);
        return redirect()->route('manager.karyawan.aktif')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function update(Request $request, $id) {
        $karyawan = Karyawan::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,'.$id,
            'no_tlp' => 'required|string|max:20',
            'jabatan' => 'required|string|max:100', 
            'jenis_karyawan' => 'required|string|max:100',
            'ktp' => 'nullable|mimes:jpg,jpeg,png|max:2048',
            'cv' => 'nullable|mimes:pdf,jpg,jpeg,png|max:3072',
        ]);

        $data = $request->except(['ktp', 'cv']);

        if ($request->hasFile('ktp')) {
            $data['ktp'] = $this->compressAndUpload($request->file('ktp'), 'assets/ktp', 'ktp');
        }
        if ($request->hasFile('cv')) {
            $data['cv'] = $this->compressAndUpload($request->file('cv'), 'assets/cv', 'cv');
        }

        $karyawan->update($data);
        return back()->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function nonaktifkan($id) {
        Karyawan::findOrFail($id)->update(['status' => 'nonaktif']);
        return back()->with('success', 'Karyawan telah dinonaktifkan.');
    }

    public function aktifkan($id) {
        Karyawan::findOrFail($id)->update(['status' => 'aktif']);
        return back()->with('success', 'Karyawan telah diaktifkan kembali.');
    }

    public function storeAkun(Request $request) {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|confirmed',
        ]);

        DB::beginTransaction();
        try {
            $karyawan = Karyawan::findOrFail($request->karyawan_id);
            
            $user = User::create([
                'name' => $karyawan->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password), // Atau auto-hash jika di model
                'role' => 'karyawan'
            ]);

            $karyawan->update(['user_id' => $user->id]);
            
            DB::commit();
            return back()->with('success', 'Akun berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat akun.');
        }
    }

    // Fungsi Kompresi Gambar Native
    private function compressAndUpload($file, $folder, $prefix) {
        $destinationPath = public_path($folder);
        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $filename = $prefix . '_' . time() . '_' . uniqid() . '.' . $extension;
        $fullPath = $destinationPath . '/' . $filename;

        // Kompresi hanya untuk JPG/PNG, jika PDF langsung pindahkan
        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $info = getimagesize($file->getPathname());
            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($file->getPathname());
                imagejpeg($image, $fullPath, 75); // Kualitas 75%
                imagedestroy($image);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($file->getPathname());
                imagealphablending($image, false);
                imagesavealpha($image, true);
                imagepng($image, $fullPath, 7); // Kompresi level 7
                imagedestroy($image);
            } else {
                $file->move($destinationPath, $filename);
            }
        } else {
            $file->move($destinationPath, $filename);
        }

        return $folder . '/' . $filename;
    }

    public function checkAvailability(Request $request) 
{
    $type = $request->query('type'); // bisa 'email', 'no_tlp', atau 'username'
    $value = $request->query('value');

    // Validasi tipe pencarian untuk keamanan
    if (!in_array($type, ['email', 'no_tlp', 'username'])) {
        return response()->json(['exists' => false]);
    }

    $exists = false;

    if ($type === 'username') {
        // CEK DI TABEL USERS
        $exists = User::where('username', $value)->exists();
    } 
    elseif ($type === 'email') {
        // CEK DI TABEL KARYAWANS DAN USERS
        $existsInKaryawan = Karyawan::where('email', $value)->exists();
        $existsInUser = User::where('email', $value)->exists();
        $exists = $existsInKaryawan || $existsInUser;
    } 
    elseif ($type === 'no_tlp') {
        // CEK DI TABEL KARYAWANS
        $exists = Karyawan::where('no_tlp', $value)->exists();
    }

    return response()->json([
        'exists' => $exists
    ]);
}
}