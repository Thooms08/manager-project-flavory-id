<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\VerifikasiManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VerifikasiManagerController extends Controller
{
    // Ubah parameter menjadi $uuid
    public function showForm($uuid)
    {
        return view('verifikasi_manager', compact('uuid'));
    }

    public function verify(Request $request, $uuid)
    {
        $request->validate([
            'kode' => 'required|string|size:6'
        ]);

        try {
            // 1. Cari Manager berdasarkan UUID
            $manager = Manager::where('uuid', $uuid)->first();

            // Jika iseng mengganti UUID di URL
            if (!$manager) {
                return response()->json(['success' => false, 'message' => 'Data pendaftaran tidak valid atau tidak ditemukan!'], 404);
            }

            // 2. Cari data verifikasinya berdasarkan ID Manager yang ditemukan
            $verifikasi = VerifikasiManager::where('manager_id', $manager->id)
                            ->where('kode_verifikasi', $request->kode)
                            ->first();

            if (!$verifikasi) {
                return response()->json(['success' => false, 'message' => 'Kode verifikasi tidak valid!'], 400);
            }

            if ($verifikasi->is_verified) {
                return response()->json(['success' => false, 'message' => 'Akun sudah diverifikasi sebelumnya.'], 400);
            }

            if (now()->greaterThan($verifikasi->expired_at)) {
                return response()->json(['success' => false, 'message' => 'Kode verifikasi sudah kedaluwarsa! Silakan minta kode baru.'], 400);
            }

            DB::transaction(function () use ($verifikasi, $manager) {
                $verifikasi->update(['is_verified' => true]);
                $manager->update(['status' => 'aktif']);
            });

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Verifikasi Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}