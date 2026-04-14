<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Manager;

class ManagerController extends Controller
{
    /**
     * Menampilkan halaman dashboard manager.
     */
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        
        // Mengambil data manager yang berelasi dengan user ini
        $manager = Manager::where('user_id', $user->id)->first();

        // Mengirimkan data user dan manager ke view dashboard
        return view('manager.index', compact('user', 'manager'));
    }

    /**
     * Membuat Manager Key secara otomatis (8 karakter campuran).
     */
    public function generateKey()
    {
        $manager = Manager::where('user_id', Auth::id())->first();

        if ($manager) {
            // Membuat 8 karakter acak huruf kapital dan angka
            $newKey = strtoupper(Str::random(8));
            
            $manager->update([
                'manager_key' => $newKey
            ]);

            return redirect()->back()->with('success', 'Manager Key berhasil dibuat!');
        }

        return redirect()->back()->with('error', 'Data Manager tidak ditemukan.');
    }
}