<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Manager | Key.Flavory.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">

    <meta name="title" content="Daftar Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta name="description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel dalam satu platform efisien.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Daftar Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="og:description" content="Kelola absensi dan operasional bisnis Anda dengan lebih cerdas dan efisien bersama Key.Flavory.id.">
    <meta property="og:image" content="{{ asset('logo-key.png') }}">
    <meta property="og:image:alt" content="Logo Key.Flavory.id">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Daftar Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="twitter:description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel.">
    <meta property="twitter:image" content="{{ asset('logo-key.png') }}">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-orange-50 text-slate-800 antialiased min-h-screen flex flex-col items-center justify-center py-8">
    <div class="fixed top-6 left-6 z-50">
    <a href="{{ url('/') }}" class="group flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full border border-slate-200 shadow-sm hover:shadow-md transition-all text-slate-600 hover:text-orange-600">
        <i class="bi bi-arrow-left transition-transform group-hover:-translate-x-1"></i>
        <span class="text-sm font-semibold">Beranda</span>
    </a>
</div>

  <div class="w-full max-w-md md:max-w-3xl px-4 md:px-6" 
    x-data="{ 
        step: 1, 
        showPass: false, 
        usernameError: '', 
        passwordError: '', 
        confirmPasswordError: '', 
        passwordValue: '',
        
        lanjutKeStepBerikutnya() {
            if (this.usernameError !== '' || this.confirmPasswordError !== '') {
                Swal.fire({ icon: 'error', title: 'Oops...', text: 'Silakan perbaiki isian yang masih salah (warna merah)!' });
                return;
            }

            let currentStep = document.getElementById('step' + this.step);
            let inputs = currentStep.querySelectorAll('[required]');
            let valid = true;

            for (let input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity(); 
                    valid = false;
                    break;
                }
            }

            if (valid) {
                this.step++;
            }
        }
    }" x-cloak>
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-orange-500 rounded-2xl shadow-lg mb-3">
                <i class="bi bi-shop text-white text-xl md:text-2xl"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-orange-600 tracking-tight">Flavory<span class="text-slate-900">.id</span></h1>
            <p class="text-slate-500 mt-1 font-medium text-xs md:text-sm">Registrasi Manager Ekosistem Digital</p>
        </div>

        <div class="flex items-center justify-between mb-8 px-8 max-w-md mx-auto relative">
            <div class="absolute left-8 right-8 top-1/2 h-1 bg-slate-200 -z-10 -translate-y-1/2"></div>
            <div class="absolute left-8 right-8 top-1/2 h-1 bg-orange-500 -z-10 -translate-y-1/2 transition-all duration-500" 
                 :style="'width: ' + ((step - 1) * 50) + '%'"></div>

            <template x-for="i in 3">
                <div :class="step >= i ? 'bg-orange-500 text-white shadow-lg ring-4 ring-orange-100' : 'bg-white text-slate-400 border border-slate-200'" 
                     class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all duration-500">
                    <span x-text="i"></span>
                </div>
            </template>
        </div>

        <div class="glass-effect rounded-[2rem] md:rounded-3xl shadow-2xl overflow-hidden border border-white">
            <form action="{{ route('register') }}" method="POST" class="p-6 md:p-8" id="registerForm">
                @csrf
                
                @if ($errors->any() || session('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                        <div class="flex items-start">
                            <i class="bi bi-exclamation-circle-fill text-red-500 mt-0.5 mr-3"></i>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Pendaftaran Tertunda:</h3>
                                <ul class="mt-1 list-disc list-inside text-xs text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    @if(session('error'))
                                        <li>{{ session('error') }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div id="step1" x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                    <div class="mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-slate-900">Tahap 1: Buat Akun</h2>
                        <p class="text-slate-500 text-sm mt-1">Kredensial untuk login ke sistem Flavory.id</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" value="{{ old('username') }}" placeholder="Contoh: thomas_admin" required 
                                    class="w-full pl-11 pr-4 py-3 bg-slate-50 border rounded-xl outline-none transition-all"
                                    :class="usernameError ? 'border-red-500 focus:ring-4 focus:ring-red-100' : 'border-slate-200 focus:ring-4 focus:ring-orange-100 focus:border-orange-500'"
                                    @input.debounce.500ms="
                                        if($event.target.value.length > 2) {
                                            fetch('/check-availability?value=' + $event.target.value)
                                            .then(res => res.json())
                                            .then(data => { usernameError = data.available ? '' : 'Username sudah terpakai!'; });
                                        } else { usernameError = ''; }
                                    ">
                            </div>
                            <p x-show="usernameError" x-text="usernameError" class="text-red-500 text-xs mt-1 font-semibold" x-transition></p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
                                <input :type="showPass ? 'text' : 'password'" name="password" x-model="passwordValue" placeholder="Minimal 8 karakter" required 
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-orange-100 focus:border-orange-500 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-1">Konfirmasi Password</label>
                                <input :type="showPass ? 'text' : 'password'" name="password_confirmation" placeholder="Ulangi password" required 
                                    class="w-full px-4 py-3 bg-slate-50 border rounded-xl outline-none transition-all"
                                    :class="confirmPasswordError ? 'border-red-500 focus:ring-4 focus:ring-red-100' : 'border-slate-200 focus:ring-4 focus:ring-orange-100 focus:border-orange-500'"
                                    @input="confirmPasswordError = ($event.target.value !== passwordValue && $event.target.value !== '') ? 'Password tidak cocok!' : '';">
                                <p x-show="confirmPasswordError" x-text="confirmPasswordError" class="text-red-500 text-xs mt-1 font-semibold" x-transition></p>
                            </div>
                        </div>
                        <div class="flex items-center mt-2">
                            <input type="checkbox" id="show-pass" class="w-4 h-4 text-orange-500 rounded border-slate-300 focus:ring-orange-500" @change="showPass = !showPass">
                            <label for="show-pass" class="ml-2 text-xs text-slate-600 cursor-pointer">Tampilkan Password</label>
                        </div>
                    </div>
                </div>

                <div id="step2" x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                    <div class="mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-slate-900">Tahap 2: Profil Manager</h2>
                        <p class="text-slate-500 text-sm mt-1">Lengkapi data diri dan jenis bisnis Anda.</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap Manager</label>
                            <input type="text" name="nama_manager" value="{{ old('nama_manager') }}" placeholder="Nama Lengkap Anda" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-orange-100 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Email Aktif</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-orange-100 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor WhatsApp</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400"><i class="bi bi-whatsapp"></i></span>
                                <input type="number" name="no_wa" value="{{ old('no_wa') }}" placeholder="0812..." required class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-orange-100 outline-none">
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Kategori / Jenis Bisnis</label>
                            <select name="jenis_bisnis" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-4 focus:ring-orange-100 outline-none text-sm">
                                <option value="">-- Pilih Jenis Bisnis --</option>
                                <option value="F&B / Kuliner" {{ old('jenis_bisnis') == 'F&B / Kuliner' ? 'selected' : '' }}>F&B / Kuliner (Cafe, Resto)</option>
                                <option value="Retail" {{ old('jenis_bisnis') == 'Retail' ? 'selected' : '' }}>Retail Minimarket</option>
                                <option value="Jasa" {{ old('jenis_bisnis') == 'Jasa' ? 'selected' : '' }}>Jasa (Salon, Bengkel)</option>
                                <option value="Lainnya" {{ old('jenis_bisnis') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="step3" x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">
                    <div class="mb-6">
                        <h2 class="text-xl md:text-2xl font-bold text-slate-900">Tahap 3: Pembayaran</h2>
                        <p class="text-slate-500 text-sm mt-1">Investasi sekali bayar untuk akses selamanya.</p>
                    </div>

                    <div class="space-y-5">
                        <div class="bg-orange-50 border-2 border-orange-200 rounded-xl p-5 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-slate-800 text-lg">Akses Seumur Hidup</h3>
                                <p class="text-sm text-slate-500 mt-1">Tanpa biaya bulanan atau tahunan.</p>
                            </div>
                            <div class="text-right">
                                <span class="block font-black text-2xl text-orange-600">Rp 88.000</span>
                                <span class="text-xs font-semibold text-slate-500 bg-white px-2 py-1 rounded-md border border-slate-200 inline-block mt-1">One-Time</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Metode Pembayaran</label>
                            <select name="metode_pembayaran" required class="w-full p-4 bg-white border-2 border-slate-200 rounded-xl outline-none focus:border-orange-500 font-bold text-slate-700 cursor-pointer">
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="QRIS">QRIS Instan</option>
                                <option value="BCA">BCA Virtual Account</option>
                                <option value="MANDIRI">Mandiri Virtual Account</option>
                                <option value="BRI">BRI Virtual Account</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse md:flex-row items-center justify-between gap-4 mt-10 pt-6 border-t border-slate-100">
                    <button type="button" x-show="step > 1" @click="step--" 
                            class="w-full md:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all">
                        <i class="bi bi-chevron-left mr-1"></i> Kembali
                    </button>
                    
                    <button type="button" x-show="step < 3" 
                        @click="lanjutKeStepBerikutnya()" 
                        class="w-full md:w-auto md:ml-auto px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg transition-all">
                        Lanjut <i class="bi bi-chevron-right ml-1"></i>
                    </button>

                    <button type="submit" x-show="step === 3" 
                            class="w-full md:w-auto md:ml-auto px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-black rounded-xl shadow-xl transition-all transform hover:scale-[1.02]">
                        BAYAR SEKARANG <i class="bi bi-send-check-fill ml-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>