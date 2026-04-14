<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Manager;
use App\Models\Karyawan;
use App\Models\Relasi;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi Dasar (Role, Username, Password wajib diisi untuk semua kondisi)
        $request->validate([
            'role_login' => 'required|in:manager,karyawan',
            'username'   => 'required|string',
            'password'   => 'required|string',
        ], [
            'role_login.required' => 'Silakan pilih role akses Anda.',
            'username.required'   => 'Username wajib diisi.',
            'password.required'   => 'Password wajib diisi.',
        ]);

        $role = $request->role_login;
        $remember = $request->boolean('remember');

        // ================================================================
        // LOGIKA KARYAWAN: BELUM ADA AKUN (REGISTRASI + AUTO LOGIN)
        // ================================================================
        if ($role === 'karyawan' && $request->status_akun === 'belum_ada') {
            
            // Validasi khusus untuk pembuatan akun karyawan baru
            $request->validate([
                'manager_key'      => 'required|string',
                'email_konfirmasi' => 'required|email',
                'username'         => 'unique:users,username', // Pastikan username belum dipakai
            ], [
                'manager_key.required'      => 'Manager Key wajib diisi untuk verifikasi.',
                'email_konfirmasi.required' => 'Email wajib diisi untuk pencocokan data.',
                'username.unique'           => 'Username ini sudah digunakan, silakan pilih yang lain.',
            ]);

            try {
                DB::beginTransaction();

                // Cek Validitas Manager Key
                $manager = Manager::where('manager_key', $request->manager_key)->first();
                if (!$manager) {
                    return back()->withErrors(['manager_key' => 'Manager Key tidak valid.'])->withInput();
                }

                // Cek Data Karyawan berdasarkan email dan terhubung dengan manager tersebut
                $karyawan = Karyawan::where('email', $request->email_konfirmasi)
                                    ->where('manager_id', $manager->id)
                                    ->first();
                
                if (!$karyawan) {
                    return back()->withErrors(['email_konfirmasi' => 'Data karyawan dengan email ini tidak ditemukan pada Outlet Manager terkait.'])->withInput();
                }

                // Cek apakah karyawan ini sudah pernah membuat akun (Mencegah Duplikasi)
                if ($karyawan->user_id !== null) {
                    return back()->withErrors(['email_konfirmasi' => 'Karyawan ini sudah memiliki akses login (Akun sudah ada).'])->withInput();
                }

                // Buat User Autentikasi Baru
                $user = User::create([
                    'name'     => $karyawan->nama,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role'     => 'karyawan',
                ]);

                // Update data Karyawan (Sambungkan user_id)
                $karyawan->update(['user_id' => $user->id]);

                // Insert ke tabel Relasis
                Relasi::create([
                    'karyawan_id' => $karyawan->id,
                    'manager_key' => $request->manager_key,
                ]);

                DB::commit();

                // Auto Login
                Auth::login($user, $remember);
                $request->session()->regenerate();

                return redirect()->intended('/karyawan/index');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors(['username' => 'Terjadi kesalahan sistem saat membuat akun: ' . $e->getMessage()])->withInput();
            }
        }

        // ================================================================
        // LOGIKA LOGIN NORMAL (MANAGER ATAU KARYAWAN SUDAH ADA AKUN)
        // ================================================================
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $userRole = Auth::user()->role;

            // Pastikan role yang dipilih di UI sama dengan role aslinya di Database
            if ($userRole !== $role) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return back()->withErrors([
                    'role_login' => "Akses ditolak. Akun Anda terdaftar sebagai $userRole, bukan $role.",
                ])->withInput();
            }

            // Redirect sesuai role
            if ($userRole === 'manager') {
                return redirect()->intended('/manager');
            } else {
                return redirect()->intended('/karyawan/index');
            }
        }

        // Jika username/password salah
        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username', 'role_login', 'status_akun');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}