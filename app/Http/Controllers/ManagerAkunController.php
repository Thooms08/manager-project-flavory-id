<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Manager; // Pastikan model Manager sudah ada

class ManagerAkunController extends Controller
{
    // 1. Menampilkan Halaman Profile
    public function index()
    {
        $user = Auth::user();
        // Mengambil data manager berdasarkan user_id
        $manager = Manager::where('user_id', $user->id)->first();

        return view('manager.profile', compact('user', 'manager'));
    }

    // 2. Update Data Profil (Tabel managers)
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_whatsapp' => 'required|string|max:20',
            'jenis_bisnis' => 'required|string|max:255',
        ]);

        $manager = Manager::where('user_id', Auth::id())->first();

        if ($manager) {
            $manager->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_whatsapp' => $request->no_whatsapp,
                'jenis_bisnis' => $request->jenis_bisnis,
            ]);
        } else {
            // Opsional: Create data jika belum ada (safety fallback)
            Manager::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'email' => $request->email,
                'no_whatsapp' => $request->no_whatsapp,
                'jenis_bisnis' => $request->jenis_bisnis,
            ]);
        }

        return redirect()->back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    // 3. Update Akun Login (Tabel users)
    public function updateAkun(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            // Username harus unik kecuali untuk dirinya sendiri
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6', // Boleh kosong
        ]);

        $user->username = $request->username;
        
        // Update password hanya jika diisi (di-hash menggunakan Hash::make)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->back()->with('success', 'Username / Password berhasil diperbarui!');
    }

    // 4. AJAX Endpoint: Validasi Ketersediaan Username
    public function checkUsername(Request $request)
    {
        $username = $request->query('username');
        $currentUserId = Auth::id();

        if (!$username) {
            return response()->json([
                'valid' => false, 
                'message' => 'Username tidak boleh kosong.'
            ]);
        }

        // Cek apakah username dipakai oleh manager lain
        $exists = User::where('username', $username)
            ->where('role', 'manager')
            ->where('id', '!=', $currentUserId)
            ->exists();

        if ($exists) {
            return response()->json([
                'valid' => false, 
                'message' => 'Username ini sudah digunakan oleh manager lain.'
            ]);
        }

        return response()->json([
            'valid' => true, 
            'message' => 'Username tersedia dan dapat digunakan.'
        ]);
    }
}