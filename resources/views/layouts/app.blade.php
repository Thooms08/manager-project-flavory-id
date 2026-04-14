<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Key.Flavory.id - Solusi HRMS modern untuk manajemen karyawan, absensi, dan penjadwalan shift fleksibel secara efisien.">
    
    <title>@yield('title', 'Key.Flavory.id - HRMS & Manajemen Karyawan Modern')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">

    <meta name="title" content="Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta name="description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel dalam satu platform efisien.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="og:description" content="Kelola absensi dan operasional bisnis Anda dengan lebih cerdas dan efisien bersama Key.Flavory.id.">
    <meta property="og:image" content="{{ asset('logo-key.png') }}">
    <meta property="og:image:alt" content="Logo Key.Flavory.id">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="twitter:description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel.">
    <meta property="twitter:image" content="{{ asset('logo-key.png') }}">
        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --brand-primary: #f97316; /* Orange 500 */
            --brand-hover: #ea580c;   /* Orange 600 */
            --brand-light: #fff7ed;   /* Orange 50 */
            --text-main: #0f172a;
            --text-muted: #64748b;
            --bg-app: #f8fafc;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background-color: var(--bg-app);
            -webkit-font-smoothing: antialiased;
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-main);
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 15px !important;
        }
        
        .nav-link:hover, .nav-link.active { 
            color: var(--brand-primary) !important; 
            font-weight: 600;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: var(--brand-primary);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 70%;
        }

        /* Animasi Hamburger Menu */
        .navbar-toggler {
            transition: all 0.3s ease-in-out;
            outline: none !important;
            box-shadow: none !important;
        }

        .navbar-toggler i {
            display: inline-block;
            transition: transform 0.4s cubic-bezier(0.68, -0.6, 0.32, 1.6);
        }

        /* Saat menu terbuka (dikontrol via JS nanti) */
        .navbar-toggler.is-active i {
            transform: rotate(180deg);
        }

        /* Buttons */
        .btn-brand {
            background-color: var(--brand-primary);
            color: white;
            border-radius: 50rem;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }
        .btn-brand:hover {
            background-color: var(--brand-hover);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
        }
        
        .btn-outline-brand {
            border: 2px solid var(--brand-primary);
            color: var(--brand-primary);
            border-radius: 50rem;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }
        .btn-outline-brand:hover {
            background-color: var(--brand-primary);
            color: white;
        }

        /* Footer */
        .footer-custom {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 4rem 0 2rem 0;
        }
        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: 0.2s;
        }
        .footer-link:hover {
            color: var(--brand-primary);
        }
    </style>
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ url('/') }}">
                <img src="{{ asset('logo-key.png') }}" alt="Logo Key Flavory" width="35" height="35" class="rounded object-fit-cover shadow-sm">
                <span>Key.Flavory.id</span>
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" id="hamburger-toggle">
                <i class="bi bi-list fs-1 text-main"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#harga">Harga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('panduan.*') ? 'active' : '' }}" href="{{ route('panduan.daftar') }}">Panduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang</a>
                    </li>
                </ul>
                <div class="d-flex gap-2">
                    @guest
                        {{-- Tombol ini HANYA muncul jika user BELUM login --}}
                        <a href="{{ route('login') }}" class="btn btn-outline-brand">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-brand">Daftar</a>
                    @else
                        {{-- Tombol ini HANYA muncul jika user SUDAH login --}}
                        
                        {{-- Arahkan ke dashboard sesuai role (sesuaikan dengan logic aplikasi Anda) --}}
                        @if(auth()->user()->role === 'manager') 
                            <a href="{{ route('manager.index') }}" class="btn btn-brand">Dashboard Manager</a>
                        @else
                            <a href="{{ route('karyawan.index') }}" class="btn btn-brand">Dashboard Karyawan</a>
                        @endif

                        {{-- Tombol Logout --}}
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger" style="border-radius: 50rem; font-weight: 600; padding: 0.6rem 1.5rem;">
                                Keluar
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4 justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('logo-key.png') }}" alt="Logo Key Flavory" width="30" height="30" class="rounded">
                        <h5 class="fw-bold mb-0">Key.Flavory.id</h5>
                    </div>
                    <p class="text-muted small mb-4">
                        Platform HRMS modern untuk mengelola absensi, jadwal shift, dan manajemen karyawan secara efisien. Dirancang untuk kemajuan operasional bisnis Anda.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="https://www.instagram.com/flavory_id1?igsh=aTY3ZHduaHVhdzFz" target="_blank" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.tiktok.com/@flavory_id1?_r=1&_t=ZS-95W6BN5eAWz" target="_blank" class="text-muted fs-5"><i class="bi bi-tiktok"></i></a>
                        <a href="https://www.youtube.com/@flavory_id1" class="text-muted fs-5" target="_blank"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold mb-3">Tautan Cepat</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 small">
                        <li><a href="{{ route('tentang') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('faq') }}" class="footer-link">FAQ</a></li>
                        <li><a href="{{ route('syarat-ketentuan') }}" class="footer-link">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('kebijakan-privasi') }}" class="footer-link">Kebijakan Privasi</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                    <ul class="list-unstyled d-flex flex-column gap-3 small">
                        <li class="d-flex align-items-start gap-3">
                            <i class="bi bi-geo-alt-fill text-orange"></i>
                            <span class="text-muted">Karawang, Jawa Barat, Indonesia</span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <i class="bi bi-envelope-fill text-orange"></i>
                            <a href="mailto:support@flavory.id" class="footer-link">adminku@flavory.id</a>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <i class="bi bi-whatsapp text-orange"></i>
                            <a href="https://wa.me/6285797574754" target="_blank" class="footer-link">+62 8579-7574-754</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <hr class="mt-5 mb-4 border-secondary-subtle">
            
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <small class="text-muted">&copy; <span id="currentYear"></span> Key.Flavory.id. All Rights Reserved..</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('currentYear').textContent = new Date().getFullYear();
        const toggleBtn = document.getElementById('hamburger-toggle');
    const icon = toggleBtn.querySelector('i');
    const navbarCollapse = document.getElementById('navbarNav');

    toggleBtn.addEventListener('click', function() {
        // Tambah/lepas class untuk animasi putar
        this.classList.toggle('is-active');

        // Ganti ikon list ke x atau sebaliknya
        if (this.classList.contains('is-active')) {
            icon.classList.replace('bi-list', 'bi-x');
        } else {
            icon.classList.replace('bi-x', 'bi-list');
        }
    });

    // Opsional: Tutup menu & kembalikan ikon saat link diklik (untuk mobile)
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                toggleBtn.click();
            }
        });
    });
    </script>
    
    @stack('scripts')

</body>
</html>