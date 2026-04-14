<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Akun Manager | Key.Flavory.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        /* Menghilangkan panah atas/bawah di input number */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</head>
<body class="bg-orange-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-500 rounded-2xl shadow-xl shadow-orange-200 mb-4">
                <i class="bi bi-envelope-paper text-white text-3xl"></i>
            </div>
            <h1 class="text-3xl font-extrabold text-slate-900">Verifikasi <span class="text-orange-600">Email</span></h1>
            <p class="text-slate-500 text-sm mt-2">Masukkan 6 digit angka OTP yang kami kirimkan ke email Anda.</p>
        </div>

        <div class="glass-effect rounded-[2.5rem] p-8 md:p-10 shadow-2xl border border-white">
            <div class="space-y-6">
                <div>
                    <label for="kode" class="block text-xs font-black text-slate-700 uppercase tracking-widest mb-3 text-center">Kode Verifikasi (OTP)</label>
                    <div class="relative">
                        <input type="number" id="kode" maxlength="6" inputmode="numeric" placeholder="123456" 
                               class="w-full text-center text-4xl font-black tracking-[0.5em] py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 outline-none transition-all placeholder:text-slate-200 placeholder:tracking-normal placeholder:font-medium"
                               oninput="if(this.value.length > 6) this.value = this.value.slice(0, 6);">
                    </div>
                </div>

                <button onclick="submitVerif()" id="btnVerif"
                        class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-black py-4 rounded-2xl shadow-xl shadow-orange-200 transition-all transform active:scale-95 flex items-center justify-center gap-2 tracking-widest text-sm">
                    VERIFIKASI AKUN <i class="bi bi-check-circle-fill"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        async function submitVerif() {
            const kodeInput = document.getElementById('kode');
            const btn = document.getElementById('btnVerif');
            const kode = kodeInput.value.trim();

            if (kode.length !== 6) {
                Swal.fire('Oops!', 'Masukkan 6 digit angka kode verifikasi secara lengkap.', 'warning');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-arrow-repeat animate-spin"></i> MEMPROSES...';

            try {
                // Endpoint akan sesuai dengan URL saat ini (mengandung token enkripsi)
                const res = await fetch("{{ route('verifikasi.manager.process', ['uuid' => $uuid]) }}", {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    },
                    body: JSON.stringify({ kode })
                });

                const data = await res.json();

                if (res.ok && data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Email terverifikasi. Akun Anda telah aktif!',
                        icon: 'success',
                        confirmButtonColor: '#ea580c',
                        confirmButtonText: 'Lanjut Login'
                    }).then(() => {
                        window.location.href = "/login";
                    });
                } else {
                    Swal.fire('Gagal Verifikasi', data.message || 'Kode verifikasi tidak valid.', 'error');
                    btn.disabled = false;
                    btn.innerHTML = 'VERIFIKASI AKUN <i class="bi bi-check-circle-fill"></i>';
                }
            } catch (error) {
                Swal.fire('Error', 'Terjadi kesalahan sistem atau koneksi terputus. Coba lagi.', 'error');
                btn.disabled = false;
                btn.innerHTML = 'VERIFIKASI AKUN <i class="bi bi-check-circle-fill"></i>';
            }
        }
    </script>
</body>
</html>