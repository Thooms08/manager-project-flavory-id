<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Manager;
use App\Models\VerifikasiManager;
use App\Mail\VerifikasiManagerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function checkAvailability(Request $request)
    {
        $value = $request->query('value');
        $exists = User::where('username', $value)->exists();
        
        return response()->json(['available' => !$exists]);
    }

    public function register(Request $request)
    {
        // 1. Validasi Input (Paket dihapus, metode pembayaran wajib)
        $validated = $request->validate([
            'username'          => ['required', 'string', 'min:3', 'unique:users,username'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'nama_manager'      => ['required', 'string', 'max:255'],
            'email'             => ['required', 'email'], 
            'no_wa'             => ['required', 'string', 'max:20'],
            'jenis_bisnis'      => ['required', 'string'],
            'metode_pembayaran' => ['required', 'string'], 
        ], [
            'username.unique'      => 'Username sudah digunakan, silakan cari yang lain.',
            'password.confirmed'   => 'Konfirmasi password tidak cocok.'
        ]);

        try {
            DB::beginTransaction();

            $user = User::create([
                'name'     => $validated['nama_manager'], 
                'username' => $validated['username'],
                'password' => $validated['password'], 
                'role'     => 'manager',
            ]);

            // Harga Tetap Seumur Hidup
            $amount = 500;

            $invoiceNumber = 'FM-' . time() . '-' . strtoupper(Str::random(4));
            $paymentStatus = 'pending'; // Karena berbayar, status selalu pending di awal
            $uuid = (string) Str::uuid();

            $manager = Manager::create([
                'user_id'        => $user->id,
                'uuid'           => $uuid,
                'partner_id'     => null,
                'nama'           => $validated['nama_manager'],
                'email'          => $validated['email'],
                'no_whatsapp'    => $validated['no_wa'],
                'jenis_bisnis'   => $validated['jenis_bisnis'],
                'status'         => 'nonaktif', 
                // Kolom paket dihapus dari insert
                'invoice_number' => $invoiceNumber,
                'payment_status' => $paymentStatus,
            ]);

            $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            VerifikasiManager::create([
                'manager_id'      => $manager->id,
                'kode_verifikasi' => $otp,
                'expired_at'      => now()->addMinutes(15), 
            ]);

            DB::commit();

            // Proses Pembayaran ke WijayaPay
            $method = $validated['metode_pembayaran'];
            $paymentData = $this->generateWijayaPayCheckout($invoiceNumber, $amount, $manager, $method, $manager->uuid);

            if ($paymentData) {
                $identifier = $paymentData['checkout_url'] ?? $paymentData['nomor_va'] ?? $paymentData['qr_image'] ?? '-';
                $manager->update(['payment_url' => $identifier]);

                return view('waiting-payment-manager', [
                    'payment'    => $paymentData,
                    'invoice'    => $invoiceNumber,
                    'uuid'       => $manager->uuid 
                ]);
            }

            return back()->with('error', 'Gagal memproses ke gerbang pembayaran. Hubungi admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Register Manager Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat mendaftar. Silakan coba lagi.')->withInput();
        }
    }

    private function generateWijayaPayCheckout($invoiceNumber, $amount, $manager, $method, $uuid)
    {
        $apiKey = env('WIJAYAPAY_API_KEY');
        $merchantCode = env('WIJAYAPAY_MERCHANT_CODE');
        $url = "https://wijayapay.com/api/transaction/create";

        $signature = md5($merchantCode . $apiKey . $invoiceNumber);

        $response = Http::withHeaders([
            'X-Signature' => $signature,
            'Accept'      => 'application/json',
        ])->asForm()->post($url, [
            'code_merchant'  => $merchantCode,
            'api_key'        => $apiKey,
            'ref_id'         => $invoiceNumber,
            'nominal'        => (int)$amount,
            'code_payment'   => $method,
            'customer_name'  => $manager->nama,
            'customer_email' => $manager->email,
            'customer_phone' => $manager->no_whatsapp,
            'callback_url'   => url('/api/wijayapay/manager/notification'),
            'return_url'     => route('verifikasi.manager.show', ['uuid' => $uuid]),
        ]);

        $res = $response->json();

        if ($response->successful() && isset($res['success']) && $res['success'] == true) {
            return $res['data'];
        }

        Log::error('WijayaPay Error (Manager): ' . $response->body());
        return null;
    }

    public function wijayapayNotification(Request $request)
    {
        $merchantCode = env('WIJAYAPAY_MERCHANT_CODE');
        $apiKey = env('WIJAYAPAY_API_KEY');
        
        $incomingSignature = $request->header('X-Signature');
        $refId = $request->input('data.ref_id'); 
        $status = $request->input('status');

        $mySignature = md5($merchantCode . $apiKey . $refId);

        if ($incomingSignature !== $mySignature) {
            return response()->json(['status' => false, 'message' => 'Signature mismatch'], 403);
        }

        if (strtolower($status) === 'paid') {
            $manager = Manager::where('invoice_number', $refId)->first();
            
            if ($manager && $manager->payment_status !== 'success') {
                $manager->update(['payment_status' => 'success']);
                
                $verifikasi = VerifikasiManager::where('manager_id', $manager->id)->first();
                if ($verifikasi) {
                    $verifikasi->update(['expired_at' => now()->addMinutes(15)]);
                    Mail::to($manager->email)->send(new VerifikasiManagerMail($verifikasi->kode_verifikasi));
                }
            }
        } 

        return response()->json(['status' => true]);
    }
}