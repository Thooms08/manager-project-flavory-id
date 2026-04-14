<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Manager | Key.Flavory.id</title>
    
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
            --orange-hover: #e06c0c;
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

        /* Navbar Styling */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 15px rgba(0,0,0,0.04);
            border-bottom: 1px solid rgba(0,0,0,0.02);
        }
        .navbar-brand-text { font-weight: 700; letter-spacing: -0.5px; }

        /* Card Custom Styling */
        .card-custom {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        /* Button Styling */
        .btn-orange { 
            background: var(--orange-primary); 
            color: white; 
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1.25rem;
            border: none;
            transition: all 0.3s ease;
        } 
        .btn-orange:hover:not(:disabled) { 
            background: var(--orange-hover); 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(253, 126, 20, 0.2);
        }
        .btn-orange:disabled {
            background: #ffc299;
            cursor: not-allowed;
        }
        
        .btn-outline-back {
            color: var(--text-dark);
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-outline-back:hover {
            background: #f8f9fa;
            color: var(--orange-primary);
            border-color: #d3d9df;
        }

        /* Form Controls */
        .form-control {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid #dee2e6;
        }
        .form-control:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.15);
        }
        
        .section-icon {
            width: 40px; height: 40px;
            background: #fff8f1;
            color: var(--orange-primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="{{ route('manager.index') }}" class="navbar-brand d-flex align-items-center text-decoration-none">
                <div class="d-flex align-items-center justify-content-center rounded-circle me-2 text-white" style="width: 36px; height: 36px; background-color: var(--orange-primary);">
                    <i class="bi bi-pie-chart-fill fs-5"></i>
                </div>
                <span class="navbar-brand-text fs-5">Dashboard<span class="text-secondary fw-normal">Manager</span></span>
            </a>
        </div>
    </nav>

    <main class="container mt-4 mb-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold mb-1">Pengaturan Profil</h3>
                <p class="text-muted small mb-0">Kelola informasi pribadi dan data otentikasi akun Anda.</p>
            </div>
            <div>
                <a href="{{ route('manager.index') }}" class="btn btn-outline-back px-3 py-2">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <i class="bi bi-check-circle-fill fs-5 me-3"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> 
                    <strong>Terdapat beberapa kesalahan:</strong>
                </div>
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="section-icon"><i class="bi bi-person-vcard fs-5"></i></div>
                        <h5 class="fw-bold mb-0">Informasi Profil Manager</h5>
                    </div>
                    
                    <form action="{{ route('manager.profile.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label fw-medium small">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="{{ old('nama', $manager->nama ?? '') }}" required placeholder="Contoh: Budi Santoso">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium small">Alamat Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $manager->email ?? '') }}" required placeholder="manager@contoh.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium small">No WhatsApp</label>
                                <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp', $manager->no_whatsapp ?? '') }}" required placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-medium small">Jenis Bisnis</label>
                            <input type="text" name="jenis_bisnis" class="form-control" value="{{ old('jenis_bisnis', $manager->jenis_bisnis ?? '') }}" required placeholder="F&B, Retail, dll">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-orange">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-custom h-100 p-4">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="section-icon"><i class="bi bi-shield-lock fs-5"></i></div>
                        <h5 class="fw-bold mb-0">Pengaturan Akun & Keamanan</h5>
                    </div>
                    
                    <form action="{{ route('manager.profile.update_akun') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3 position-relative">
                            <label class="form-label fw-medium small">Username Login</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-at"></i></span>
                                <input type="text" name="username" id="usernameInput" class="form-control border-start-0 ps-0" value="{{ old('username', $user->username) }}" required autocomplete="off">
                            </div>
                            <div id="usernameFeedback" class="small mt-1 mt-2"></div>
                        </div>

                        <hr class="text-muted opacity-25 my-4">

                        <div class="mb-4">
                            <label class="form-label fw-medium small d-flex justify-content-between">
                                <span>Password Baru</span>
                                <span class="text-muted fw-normal" style="font-size: 0.75rem;">(Opsional)</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="Biarkan kosong jika tidak diubah" minlength="6">
                            </div>
                            <small class="text-muted d-block mt-1"><i class="bi bi-info-circle me-1"></i>Isi hanya jika Anda ingin mengganti password lama.</small>
                        </div>

                        <div class="text-end mt-auto">
                            <button type="submit" id="btnSimpanAkun" class="btn btn-orange w-100">
                                <i class="bi bi-check2-circle me-1"></i> Simpan Username / Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputUsername = document.getElementById('usernameInput');
            const feedbackArea = document.getElementById('usernameFeedback');
            const btnSubmit = document.getElementById('btnSimpanAkun');
            
            // Simpan username lama untuk di-bypass agar tidak error "sudah dipakai" kalau isinya tidak diubah
            const originalUsername = "{{ $user->username }}";
            let debounceTimer;

            inputUsername.addEventListener('input', function() {
                clearTimeout(debounceTimer);
                
                const currentVal = this.value.trim();

                // Reset state jika kosong
                if(currentVal === '') {
                    feedbackArea.innerHTML = '<span class="text-danger"><i class="bi bi-x-circle me-1"></i> Username tidak boleh kosong!</span>';
                    inputUsername.classList.remove('is-valid');
                    inputUsername.classList.add('is-invalid');
                    btnSubmit.disabled = true;
                    return;
                }

                // Jika username sama dengan yang sekarang sedang dipakai (tidak ada perubahan)
                if(currentVal === originalUsername) {
                    feedbackArea.innerHTML = '<span class="text-secondary"><i class="bi bi-info-circle me-1"></i> Username saat ini.</span>';
                    inputUsername.classList.remove('is-invalid', 'is-valid');
                    btnSubmit.disabled = false;
                    return;
                }

                // UI Loading
                feedbackArea.innerHTML = '<span class="text-muted"><i class="bi bi-hourglass-split me-1"></i> Mengecek ketersediaan...</span>';
                
                // Debounce 500ms agar server tidak berat
                debounceTimer = setTimeout(() => {
                    fetch(`{{ route('manager.check_username') }}?username=${currentVal}`)
                        .then(response => response.json())
                        .then(data => {
                            if(data.valid) {
                                // Tersedia
                                feedbackArea.innerHTML = `<span class="text-success"><i class="bi bi-check-circle me-1"></i> ${data.message}</span>`;
                                inputUsername.classList.remove('is-invalid');
                                inputUsername.classList.add('is-valid');
                                btnSubmit.disabled = false;
                            } else {
                                // Sudah Terpakai
                                feedbackArea.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle me-1"></i> ${data.message}</span>`;
                                inputUsername.classList.remove('is-valid');
                                inputUsername.classList.add('is-invalid');
                                btnSubmit.disabled = true;
                            }
                        })
                        .catch(error => {
                            feedbackArea.innerHTML = '<span class="text-danger">Gagal mengecek ke server.</span>';
                        });
                }, 500); 
            });
        });
    </script>
</body>
</html>