<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran | Key.Flavory.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl p-8 text-center border border-white relative overflow-hidden">
        
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-100 rounded-full blur-2xl opacity-50 pointer-events-none"></div>

        <div class="mb-6 relative z-10">
            <h2 class="text-2xl font-extrabold text-slate-800">Selesaikan Pembayaran</h2>
            <p class="text-slate-500 text-sm mt-1">{{ $payment['payment_name'] ?? 'Metode Pembayaran' }}</p>
        </div>

        <div class="bg-slate-50 p-6 rounded-3xl border-2 border-dashed border-orange-200 mb-6 w-full relative z-10">
            @if(isset($payment['qr_image']))
                <img src="{{ $payment['qr_image'] }}" alt="QRIS" class="w-64 h-64 mx-auto rounded-xl shadow-sm mb-2">
                <p class="text-xs text-slate-500 font-medium">Scan QR Code menggunakan aplikasi Bank/E-Wallet</p>
            @elseif(isset($payment['nomor_va']))
                <p class="text-xs text-slate-400 mb-2 uppercase tracking-widest font-bold">Nomor Virtual Account</p>
                <h3 class="text-3xl font-black text-orange-600 tracking-wider mb-2">{{ $payment['nomor_va'] }}</h3>
                <button onclick="navigator.clipboard.writeText('{{ $payment['nomor_va'] }}'); Swal.fire({toast:true, position:'top-end', showConfirmButton:false, timer:2000, icon:'success', title:'Disalin!'})" class="text-xs font-bold bg-orange-100 text-orange-700 px-4 py-2 rounded-full hover:bg-orange-200 transition-colors shadow-sm">
                    <i class="bi bi-copy me-1"></i> Salin Nomor
                </button>
            @endif
        </div>

        @if(isset($payment['tutorial_pembayaran']))
        <div class="text-left mb-6 bg-orange-50/50 p-4 rounded-2xl relative z-10">
            <h4 class="text-xs font-bold text-orange-800 mb-2 uppercase"><i class="bi bi-info-circle me-1"></i> Cara Bayar:</h4>
            <div class="text-[10px] leading-relaxed text-slate-600 max-h-24 overflow-y-auto pr-2 custom-scrollbar">
                {!! nl2br(e($payment['tutorial_pembayaran'])) !!}
            </div>
        </div>
        @endif

        <div class="space-y-3 mb-6 relative z-10">
            <div class="flex items-center justify-center gap-2 text-orange-600 font-bold bg-orange-50 py-2 rounded-full w-max mx-auto px-4 border border-orange-100">
                <div class="w-2.5 h-2.5 bg-orange-600 rounded-full animate-ping"></div>
                <span class="text-xs tracking-widest uppercase">Menunggu Pembayaran...</span>
            </div>
            <div class="bg-slate-100 py-3 px-5 rounded-xl flex justify-between items-center mt-4">
                <span class="text-xs text-slate-500 font-medium">Total Tagihan:</span>
                <span class="font-bold text-slate-800 text-lg">Rp {{ number_format($payment['total_bayar'] ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 relative z-10">
            <p class="text-xs text-slate-400 mb-1">Nomor Invoice:</p>
            <p class="font-mono text-xs font-bold text-slate-700">{{ $invoice }}</p>
        </div>
    </div>

    <script>
        // Polling Checker setiap 3.5 detik
        let checkInterval = setInterval(function() {
            fetch('/api/check-manager-payment/{{ $invoice }}')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        clearInterval(checkInterval); // Hentikan polling
                        
                        // Notifikasi Sukses
                        Swal.fire({
                            title: 'Pembayaran Diterima!',
                            text: 'Kode OTP telah dikirim ke email Anda. Mengalihkan ke halaman verifikasi...',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                            allowOutsideClick: false
                        }).then(() => {
                            window.location.href = "{{ route('verifikasi.manager.show', ['uuid' => $uuid]) }}";
                        });
                    }
                })
                .catch(error => console.error('Error polling status:', error));
        }, 3500); 
    </script>
</body>
</html>