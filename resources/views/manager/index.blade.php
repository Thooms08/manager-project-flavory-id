<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Manager | Key.Flavory.id</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --orange-primary: #fd7e14;
            --orange-secondary: #ff9800;
            --orange-light: #fff3cd;
            --text-dark: #2b3440;
            --text-muted: #6b7280;
            --bg-body: #f4f7f6;
        }
        
        body {
            background-color: var(--bg-body);
            padding-top: 80px; 
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
        }

        /* Styling Navbar Modern (Clean White) */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 15px rgba(0,0,0,0.04);
            border-bottom: 1px solid rgba(0,0,0,0.02);
        }
        .navbar-brand-text {
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        /* Welcome Banner Gradient */
        .welcome-banner {
            background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-secondary) 100%);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(253, 126, 20, 0.15);
        }
        
        /* Ornamen Lingkaran di Banner */
        .welcome-banner::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        /* Styling Card Modern */
        .card-menu {
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: #ffffff;
            height: 100%;
        }
        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.08);
            border-color: rgba(253, 126, 20, 0.2);
        }
        
        /* Styling Icon di dalam Card (Rata Kiri) */
        .icon-wrapper {
            width: 56px;
            height: 56px;
            background-color: #fff8f1;
            color: var(--orange-primary);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        /* Link Custom Oranye */
        .link-orange {
            color: var(--orange-primary);
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: gap 0.3s ease;
            gap: 4px;
        }
        .card-menu:hover .link-orange {
            gap: 10px; 
            color: var(--orange-secondary);
        }

        /* Tombol */
        .btn-orange { 
            background: var(--orange-primary); 
            color: white; 
            border-radius: 8px;
            font-weight: 500;
            padding: 0.5rem 1.25rem;
            transition: all 0.3s ease;
            border: none;
        } 
        .btn-orange:hover { 
            background: #e06c0c; 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(253, 126, 20, 0.2);
        }

        /* Tombol Profil (BARU) */
        .btn-profile {
            background-color: transparent;
            color: var(--text-dark);
            border: 1px solid rgba(43, 52, 64, 0.15);
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-profile:hover {
            background-color: #f8f9fa;
            color: var(--orange-primary);
            border-color: rgba(253, 126, 20, 0.3);
        }

        .btn-logout {
            background-color: transparent;
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Animasi lambaian tangan */
        @keyframes wave-animation {
            0% { transform: rotate(0deg); }
            10% { transform: rotate(14deg); }
            20% { transform: rotate(-8deg); }
            30% { transform: rotate(14deg); }
            40% { transform: rotate(-4deg); }
            50% { transform: rotate(10deg); }
            60% { transform: rotate(0deg); }
            100% { transform: rotate(0deg); }
        }

        .waving-icon {
            display: inline-block;
            transform-origin: 70% 70%; 
            animation: wave-animation 2.5s infinite; 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center text-decoration-none">
                <div class="bg-orange text-white d-flex align-items-center justify-content-center rounded-circle me-2" style="width: 36px; height: 36px; background-color: var(--orange-primary);">
                    <i class="bi bi-pie-chart-fill fs-5"></i>
                </div>
                <span class="navbar-brand-text fs-5">Dashboard<span class="text-secondary fw-normal">Manager</span></span>
            </a>
            
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('panduan.data-karyawan') }}" class="btn btn-profile d-flex align-items-center">
                    <i class="bi bi-question-circle"></i>
                </a>
                <a href="{{ route('manager.profile.index') }}" class="btn btn-profile px-3 py-2 d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i> Profil
                </a>
                
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout px-3 py-2 d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mt-3 mb-5">
        
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <i class="bi bi-check-circle-fill fs-5 me-3"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-3"></i> {{ session('error') }}
            </div>
        @endif

        <div class="welcome-banner p-4 p-md-5 mb-4 text-white">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-md-8">
                    <p class="mb-1 opacity-75 fw-medium">Overview Operasional</p>
                   <h2 class="fw-bold mb-2 d-flex align-items-center">
                        Halo, {{ $user->name }}! 
                        <span class="waving-icon ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="#ffc107" stroke="#e0a800" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 11V6a2 2 0 0 0-4 0v4"></path>
                                <path d="M14 10V4a2 2 0 0 0-4 0v6"></path>
                                <path d="M10 10.5V3a2 2 0 0 0-4 0v9"></path>
                                <path d="M6 12v-1.5a2 2 0 0 0-4 0v5.5c0 3.5 2.5 6.5 6 7h3.5c3.5 0 6.5-2.5 6.5-6V12a2 2 0 0 0-4 0v1.5"></path>
                            </svg>
                        </span>
                    </h2>
                    <p class="mb-0 fw-light" style="font-size: 1.05rem;">
                        Selamat datang kembali di pusat manajemen. Pantau dan kelola tim Anda dengan mudah hari ini.
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-4 mt-md-0 d-none d-md-block">
                    <div class="bg-white bg-opacity-25 rounded-3 p-3 d-inline-block text-start backdrop-blur">
                        <small class="d-block opacity-75">Tanggal Hari Ini</small>
                        <span class="fw-semibold fs-5">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-5" style="border-radius: 16px;">
            <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-wrapper mb-0" style="width: 48px; height: 48px;">
                        <i class="bi bi-key-fill text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Manager Key</h6>
                        <p class="text-muted small mb-0">Kode unik ini digunakan untuk menghubungkan Akun karyawan dengan Akun Manager.</p>
                    </div>
                </div>
                
                <div>
                    @if(isset($manager) && $manager->manager_key)
                        <div class="d-flex align-items-center gap-2">
                            <span class="text-muted small">Key Anda:</span>
                            <code class="fs-5 text-primary bg-primary bg-opacity-10 px-3 py-2 rounded border border-primary border-opacity-25 fw-bold" style="letter-spacing: 2px;">
                                {{ $manager->manager_key }}
                            </code>
                        </div>
                    @else
                        <form action="{{ route('manager.generate_key') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-orange shadow-sm">
                                <i class="bi bi-magic me-1"></i> Buat Manager Key
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h4 class="fw-bold mb-1">Menu Utama</h4>
                <p class="text-muted small mb-0">Pilih modul untuk mengelola operasional karyawan.</p>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-4 col-md-6">
                <div class="card card-menu p-4">
                    <div class="card-body p-0 d-flex flex-column">
                        <div class="icon-wrapper">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Data Karyawan</h5>
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem;">
                            Kelola profil, tambah anggota baru, dan perbarui informasi direktori staf Anda.
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('manager.karyawan.index') }}" class="link-orange">
                                Buka Modul <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card card-menu p-4">
                    <div class="card-body p-0 d-flex flex-column">
                        <div class="icon-wrapper">
                            <i class="bi bi-calendar-range-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Manajemen Shift</h5>
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem;">
                            Atur jadwal kerja tim, tentukan rotasi harian, dan pantau produktivitas operasional.
                        </p>
                        <div class="mt-auto">
                         <a href="{{ route('manager.shift.index') }}" class="link-orange">
                                Buka Modul <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card card-menu p-4">
                    <div class="card-body p-0 d-flex flex-column">
                        <div class="icon-wrapper">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Rekap Absensi</h5>
                        <p class="card-text text-muted mb-4 flex-grow-1" style="font-size: 0.95rem;">
                            Tinjau laporan kehadiran, kelola permintaan cuti, dan evaluasi performa presensi.
                        </p>
                        <div class="mt-auto">
                            <a href="{{route ('manager.absensi.index')}}" class="link-orange">
                                Buka Modul <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>