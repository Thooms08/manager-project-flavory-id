<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Key.Flavory.id</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">

    <meta name="title" content="Daftar Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta name="description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel dalam satu platform efisien.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Log In Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="og:description" content="Kelola absensi dan operasional bisnis Anda dengan lebih cerdas dan efisien bersama Key.Flavory.id.">
    <meta property="og:image" content="{{ asset('logo-key.png') }}">
    <meta property="og:image:alt" content="Logo Key.Flavory.id">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Log In Key.Flavory.id - HRMS & Manajemen Karyawan Modern">
    <meta property="twitter:description" content="Solusi digital untuk manajemen karyawan, absensi real-time, dan penjadwalan shift fleksibel.">
    <meta property="twitter:image" content="{{ asset('logo-key.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --orange-primary: #fd7e14;
            --orange-secondary: #ff9800;
            --text-dark: #2b3440;
            --text-muted: #6b7280;
            --bg-body: #f4f7f6;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            min-height: 100vh;
            color: var(--text-dark);
            /* Hapus flex disini agar dikendalikan penuh oleh container Bootstrap */
        }

        .login-card {
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.04);
            background: #ffffff;
            width: 100%;
            max-width: 420px; /* Diperkecil sedikit agar lebih proporsional di desktop */
            overflow: hidden;
        }

        .login-header {
            background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-secondary) 100%);
            color: white;
            padding: 2.5rem 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::after {
            content: ''; position: absolute; top: -50px; right: -50px;
            width: 150px; height: 150px; background: rgba(255, 255, 255, 0.1); border-radius: 50%;
        }

        .btn-back {
            position: absolute;
            top: 15px;
            left: 15px;
            z-index: 10;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 8px;
            padding: 5px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            backdrop-filter: blur(4px);
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .icon-circle {
            width: 60px; height: 60px; background-color: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px); border-radius: 50%; display: flex;
            align-items: center; justify-content: center; margin: 0 auto 1rem auto;
            font-size: 1.75rem; color: white;
        }

        .form-control {
            border-radius: 10px; padding: 0.8rem 1rem; border: 1px solid #e5e7eb;
            background-color: #f9fafb; font-size: 0.95rem; transition: all 0.2s;
        }

        .form-control:focus {
            background-color: #ffffff; border-color: var(--orange-primary);
            box-shadow: 0 0 0 4px rgba(253, 126, 20, 0.1);
        }

        .btn-orange {
            background: linear-gradient(135deg, var(--orange-primary) 0%, var(--orange-secondary) 100%);
            color: white; font-weight: 600; border: none; border-radius: 10px;
            padding: 0.8rem; transition: all 0.3s ease;
        }

        .btn-orange:hover {
            transform: translateY(-2px); box-shadow: 0 8px 15px rgba(253, 126, 20, 0.2); color: white;
        }

        /* Styling untuk Radio Button Custom */
        .role-selector label {
            cursor: pointer; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px; transition: all 0.2s;
        }
        .role-selector input:checked + label {
            border-color: var(--orange-primary); background-color: rgba(253, 126, 20, 0.05);
            color: var(--orange-primary); font-weight: 600;
        }
        
        /* Animasi Collapse */
        .dynamic-field {
            overflow: hidden; transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            max-height: 0; opacity: 0;
        }
        .dynamic-field.show { max-height: 400px; opacity: 1; }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100 py-4 px-3">
    <div class="card login-card">
        <div class="login-header">
            <a href="{{ route('index') }}" class="btn-back">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

            <div class="icon-circle position-relative" style="z-index: 2;"><i class="bi bi-shop"></i></div>
            <h3 class="fw-bold mb-1 position-relative" style="z-index: 2; letter-spacing: -0.5px;">Key.Flavory.id</h3>
            <p class="mb-0 mt-1 opacity-75 small position-relative" style="z-index: 2;">Human Resource Management System</p>
        </div>
        
        <div class="card-body p-4 p-md-4">
            
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm small rounded-3 mb-4">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-muted">Akses Sebagai</label>
                    <div class="d-flex gap-2 role-selector">
                        <div class="flex-fill text-center position-relative">
                            <input type="radio" name="role_login" id="roleManager" value="manager" class="position-absolute opacity-0" {{ old('role_login', 'manager') == 'manager' ? 'checked' : '' }}>
                            <label for="roleManager" class="d-block w-100 m-0"><i class="bi bi-person-badge me-1"></i> Manager</label>
                        </div>
                        <div class="flex-fill text-center position-relative">
                            <input type="radio" name="role_login" id="roleKaryawan" value="karyawan" class="position-absolute opacity-0" {{ old('role_login') == 'karyawan' ? 'checked' : '' }}>
                            <label for="roleKaryawan" class="d-block w-100 m-0"><i class="bi bi-people me-1"></i> Karyawan</label>
                        </div>
                    </div>
                </div>

                <div id="karyawanStatusWrap" class="dynamic-field {{ old('role_login') == 'karyawan' ? 'show mb-4' : '' }}">
                    <div class="p-3 bg-light rounded-3 border border-light">
                        <label class="form-label small fw-bold text-muted mb-2">Status Akses Anda</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input shadow-none" type="radio" name="status_akun" id="statusSudahAda" value="sudah_ada" {{ old('status_akun', 'sudah_ada') == 'sudah_ada' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="statusSudahAda">Sudah punya akun (Langsung Login)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input shadow-none" type="radio" name="status_akun" id="statusBelumAda" value="belum_ada" {{ old('status_akun') == 'belum_ada' ? 'checked' : '' }}>
                            <label class="form-check-label small" for="statusBelumAda">Belum punya akun (Aktivasi Akses)</label>
                        </div>
                    </div>
                </div>

                <div id="claimFieldsWrap" class="dynamic-field {{ (old('role_login') == 'karyawan' && old('status_akun') == 'belum_ada') ? 'show mb-3' : '' }}">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Manager Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="manager_key" name="manager_key" value="{{ old('manager_key') }}" placeholder="Minta key dari Manager Anda">
                        <small class="text-muted" style="font-size: 0.7rem;">Gunakan kode yang diberikan oleh Manager Outlet Anda.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email Karyawan <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email_konfirmasi" name="email_konfirmasi" value="{{ old('email_konfirmasi') }}" placeholder="contoh: budi@email.com">
                        <small class="text-muted" style="font-size: 0.7rem;">Pastikan email sesuai dengan yang didaftarkan Manager.</small>
                    </div>
                    <hr class="text-muted opacity-25">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label small fw-bold" id="labelUsername">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted px-3" style="border-radius: 10px 0 0 10px; border-color: #e5e7eb;">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 ps-0" style="border-radius: 0 10px 10px 0;" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-bold" id="labelPassword">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted px-3" style="border-radius: 10px 0 0 10px; border-color: #e5e7eb;">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control border-start-0 ps-0" style="border-radius: 0 10px 10px 0;" id="password" name="password" placeholder="Masukkan password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input shadow-none" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small mt-1" for="remember">Ingat Saya</label>
                    </div>
                </div>

                <div class="d-grid mt-2">
                    <button type="submit" id="btnSubmit" class="btn btn-orange d-flex justify-content-center align-items-center gap-2">
                        Masuk Sekarang <i class="bi bi-box-arrow-in-right fs-5"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleManager = document.getElementById('roleManager');
        const roleKaryawan = document.getElementById('roleKaryawan');
        const karyawanStatusWrap = document.getElementById('karyawanStatusWrap');
        
        const statusSudahAda = document.getElementById('statusSudahAda');
        const statusBelumAda = document.getElementById('statusBelumAda');
        const claimFieldsWrap = document.getElementById('claimFieldsWrap');
        
        const labelUsername = document.getElementById('labelUsername');
        const labelPassword = document.getElementById('labelPassword');
        const btnSubmit = document.getElementById('btnSubmit');

        function updateUI() {
            if (roleKaryawan.checked) {
                karyawanStatusWrap.classList.add('show', 'mb-4');
                
                if (statusBelumAda.checked) {
                    claimFieldsWrap.classList.add('show', 'mb-3');
                    labelUsername.innerHTML = 'Buat Username Baru <span class="text-danger">*</span>';
                    labelPassword.innerHTML = 'Buat Password Baru <span class="text-danger">*</span>';
                    btnSubmit.innerHTML = 'Aktivasi & Masuk <i class="bi bi-person-check fs-5"></i>';
                } 
                else {
                    claimFieldsWrap.classList.remove('show', 'mb-3');
                    labelUsername.innerHTML = 'Username';
                    labelPassword.innerHTML = 'Password';
                    btnSubmit.innerHTML = 'Masuk Sekarang <i class="bi bi-box-arrow-in-right fs-5"></i>';
                }
            } 
            else {
                karyawanStatusWrap.classList.remove('show', 'mb-4');
                claimFieldsWrap.classList.remove('show', 'mb-3');
                statusSudahAda.checked = true; 
                
                labelUsername.innerHTML = 'Username';
                labelPassword.innerHTML = 'Password';
                btnSubmit.innerHTML = 'Masuk Sebagai Manager <i class="bi bi-box-arrow-in-right fs-5"></i>';
            }
        }

        roleManager.addEventListener('change', updateUI);
        roleKaryawan.addEventListener('change', updateUI);
        statusSudahAda.addEventListener('change', updateUI);
        statusBelumAda.addEventListener('change', updateUI);

        updateUI();
    });
</script>
</body>
</html>