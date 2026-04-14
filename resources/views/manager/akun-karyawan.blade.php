<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Akun | Key.Flavory.id</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    
    <style>
        :root {
            --orange-primary: #fd7e14;
            --orange-hover: #e86c00;
            --bg-body: #f8f9fa;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-body); 
            padding-top: 80px; 
            color: #334155;
        }

        .navbar-custom { 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px); 
            box-shadow: 0 1px 15px rgba(0,0,0,0.04); 
            border-bottom: 1px solid #f1f5f9;
        }
        
        .btn-orange { 
            background: var(--orange-primary); 
            color: white; 
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1.25rem;
            transition: all 0.3s ease;
        } 
        .btn-orange:hover { 
            background: var(--orange-hover); 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(253, 126, 20, 0.2);
        }
        .btn-orange:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            transform: none;
            box-shadow: none;
            border-color: transparent;
        }

        /* Form Custom */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border-color: #e2e8f0;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--orange-primary);
            box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.15);
        }
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0.4rem;
        }

        /* Card & Table Custom */
        .card-custom {
            background: #fff; 
            border-radius: 16px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
            border: 1px solid #f1f5f9;
        }
        .table-custom th {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #64748b;
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem;
        }
        .table-custom td {
            vertical-align: middle;
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
        }
        
        .avatar-circle {
            width: 36px;
            height: 36px;
            background-color: #fff7ed;
            color: var(--orange-primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 600;
            margin-right: 12px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="{{ route('manager.karyawan.index') }}" class="navbar-brand fw-bold text-dark d-flex align-items-center">
                <i class="bi bi-arrow-left-short fs-4 me-2"></i> Akses Akun Karyawan
            </a>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        @if(session('success')) 
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <i class="bi bi-check-circle-fill fs-5 me-3"></i> {{ session('success') }}
            </div> 
        @endif
        @if($errors->any()) 
            <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i> 
                    <span class="fw-bold">Gagal memproses data!</span>
                </div>
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div> 
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold m-0 text-dark">Manajemen Akun Login</h4>
                <p class="text-muted small m-0 mt-1">Buat kredensial login untuk karyawan agar dapat mengakses sistem kasir.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-5">
                <div class="card card-custom h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Buat Akun Baru</h5>
                        <form action="{{ route('manager.karyawan.akun.store') }}" method="POST" id="formBuatAkun">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih Karyawan <span class="text-danger">*</span></label>
                                <select name="karyawan_id" class="form-select" required>
                                    <option value="">-- Pilih Karyawan --</option>
                                    @foreach($karyawans as $k) 
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option> 
                                    @endforeach
                                </select>
                                @if($karyawans->isEmpty())
                                    <small class="text-warning mt-1 d-block"><i class="bi bi-info-circle"></i> Semua karyawan aktif sudah memiliki akun.</small>
                                @endif
                            </div>
                            
                            <div class="mb-3 position-relative">
                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="ajaxUsername" class="form-control" placeholder="Contoh: andi_kasir" required>
                                <div id="usernameFeedback" class="small mt-1 d-none"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Minimal 6 karakter" required minlength="6">
                            </div>
                            
                            <div class="mb-4 position-relative">
                                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" id="inputConfirmPassword" class="form-control" placeholder="Ketik ulang password" required>
                                <div id="passwordFeedback" class="small mt-1 d-none"></div>
                            </div>
                            
                            <button type="submit" class="btn btn-orange w-100" id="btnSubmitForm" {{ $karyawans->isEmpty() ? 'disabled' : '' }}>
                                <i class="bi bi-person-plus me-1"></i> Buat Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-7">
                <div class="card card-custom h-100">
                    <div class="card-body p-0">
                        <div class="p-4 border-bottom">
                            <h5 class="fw-bold mb-0">Daftar Akun Aktif</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Karyawan</th>
                                        <th>Username Login</th>
                                        <th>Role Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($akunKaryawans as $ak)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle">{{ strtoupper(substr($ak->nama, 0, 1)) }}</div>
                                                <div class="fw-semibold text-dark">{{ $ak->nama }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <code class="text-primary bg-primary bg-opacity-10 px-2 py-1 rounded" style="font-size: 0.9rem;">
                                                {{ $ak->user->username }}
                                            </code>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 px-2 py-1">
                                                <i class="bi bi-shield-lock me-1"></i> {{ ucfirst($ak->user->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-person-x fs-1 d-block mb-3 opacity-50"></i>
                                                <h5>Belum ada akun terdaftar</h5>
                                                <p class="small">Silakan buat akun untuk karyawan Anda melalui form di samping.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputUsername = document.getElementById('ajaxUsername');
            const inputPassword = document.getElementById('inputPassword');
            const inputConfirmPassword = document.getElementById('inputConfirmPassword');
            
            const feedbackUsername = document.getElementById('usernameFeedback');
            const feedbackPassword = document.getElementById('passwordFeedback');
            const btnSubmit = document.getElementById('btnSubmitForm');
            const isEmployeeListEmpty = {{ $karyawans->isEmpty() ? 'true' : 'false' }};

            let isValidUsername = false;
            let isPasswordMatch = false;

            // Fungsi Lock/Unlock Submit
            function toggleSubmitButton() {
                if(isEmployeeListEmpty) {
                    btnSubmit.disabled = true;
                    return;
                }
                
                // Aktif hanya jika username tersedia, password ada isinya, dan password match
                btnSubmit.disabled = !(isValidUsername && isPasswordMatch && inputPassword.value.length >= 6);
            }

            // 1. Validasi Password Match (Realtime tanpa AJAX)
            function checkPasswordMatch() {
                const pass = inputPassword.value;
                const confirmPass = inputConfirmPassword.value;

                if (!confirmPass) {
                    feedbackPassword.classList.add('d-none');
                    inputConfirmPassword.classList.remove('is-invalid', 'is-valid');
                    isPasswordMatch = false;
                } else if (pass !== confirmPass) {
                    feedbackPassword.classList.remove('d-none');
                    feedbackPassword.innerHTML = `<span class="text-danger fw-medium"><i class="bi bi-x-circle-fill me-1"></i> Password tidak cocok!</span>`;
                    inputConfirmPassword.classList.remove('is-valid');
                    inputConfirmPassword.classList.add('is-invalid');
                    isPasswordMatch = false;
                } else {
                    feedbackPassword.classList.remove('d-none');
                    feedbackPassword.innerHTML = `<span class="text-success fw-medium"><i class="bi bi-check-circle-fill me-1"></i> Password cocok.</span>`;
                    inputConfirmPassword.classList.remove('is-invalid');
                    inputConfirmPassword.classList.add('is-valid');
                    isPasswordMatch = true;
                }
                toggleSubmitButton();
            }

            inputPassword.addEventListener('keyup', checkPasswordMatch);
            inputConfirmPassword.addEventListener('keyup', checkPasswordMatch);

            // 2. Validasi Username (AJAX)
            let usernameTimer;
            
            inputUsername.addEventListener('keyup', function () {
                clearTimeout(usernameTimer);
                const value = this.value.trim();

                if (!value) {
                    feedbackUsername.classList.add('d-none');
                    this.classList.remove('is-invalid', 'is-valid');
                    isValidUsername = false;
                    toggleSubmitButton();
                    return;
                }

                // Cek format dasar (tidak boleh ada spasi)
                if (/\s/.test(value)) {
                    feedbackUsername.classList.remove('d-none');
                    feedbackUsername.innerHTML = `<span class="text-danger fw-medium"><i class="bi bi-x-circle-fill me-1"></i> Username tidak boleh mengandung spasi.</span>`;
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    isValidUsername = false;
                    toggleSubmitButton();
                    return;
                }

                feedbackUsername.classList.remove('d-none');
                feedbackUsername.innerHTML = '<span class="text-secondary"><i class="spinner-border spinner-border-sm me-1"></i> Mengecek...</span>';

                usernameTimer = setTimeout(async () => {
                    try {
                        const response = await fetch(`/manager/karyawan/check-availability?type=username&value=${value}`);
                        const data = await response.json();

                        if (data.exists) {
                            feedbackUsername.innerHTML = `<span class="text-danger fw-medium"><i class="bi bi-x-circle-fill me-1"></i> Username sudah digunakan!</span>`;
                            inputUsername.classList.remove('is-valid');
                            inputUsername.classList.add('is-invalid');
                            isValidUsername = false;
                        } else {
                            feedbackUsername.innerHTML = `<span class="text-success fw-medium"><i class="bi bi-check-circle-fill me-1"></i> Username tersedia.</span>`;
                            inputUsername.classList.remove('is-invalid');
                            inputUsername.classList.add('is-valid');
                            isValidUsername = true;
                        }
                    } catch (error) {
                        feedbackUsername.innerHTML = '<span class="text-warning small"><i class="bi bi-exclamation-triangle-fill"></i> Gagal mengecek data.</span>';
                        // Izinkan submit jika server error (validasi tetap akan ditangkap oleh Laravel Backend)
                        isValidUsername = true; 
                    }
                    toggleSubmitButton();
                }, 800);
            });
        });
    </script>
</body>
</html>