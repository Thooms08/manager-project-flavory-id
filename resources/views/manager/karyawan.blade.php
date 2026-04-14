<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Karyawan | Key.Flavory.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding-top: 80px; }
        .navbar-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); box-shadow: 0 1px 15px rgba(0,0,0,0.04); }
        .card-menu { border-radius: 16px; border: 1px solid rgba(0,0,0,0.05); transition: 0.3s; background: #fff; }
        .card-menu:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(253, 126, 20, 0.1); border-color: rgba(253,126,20,0.2); }
        .icon-box { width: 50px; height: 50px; background: #fff8f1; color: #fd7e14; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="{{ route('manager.index') }}" class="navbar-brand fw-bold text-dark"><i class="bi bi-arrow-left me-2"></i> Karyawan</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="fw-bold mb-4">Pusat Data Karyawan</h3>
        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('manager.karyawan.aktif') }}" class="text-decoration-none text-dark">
                    <div class="card card-menu p-4 h-100">
                        <div class="icon-box mb-3"><i class="bi bi-person-check-fill"></i></div>
                        <h5 class="fw-bold">Karyawan Aktif</h5>
                        <p class="text-muted small mb-0">Kelola dan tambah data tim yang sedang aktif bekerja.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('manager.karyawan.nonaktif') }}" class="text-decoration-none text-dark">
                    <div class="card card-menu p-4 h-100">
                        <div class="icon-box mb-3 text-danger bg-danger bg-opacity-10"><i class="bi bi-person-x-fill"></i></div>
                        <h5 class="fw-bold">Karyawan Nonaktif</h5>
                        <p class="text-muted small mb-0">Arsip data mantan karyawan atau yang sedang dinonaktifkan.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('manager.karyawan.akun') }}" class="text-decoration-none text-dark">
                    <div class="card card-menu p-4 h-100">
                        <div class="icon-box mb-3 text-primary bg-primary bg-opacity-10"><i class="bi bi-shield-lock-fill"></i></div>
                        <h5 class="fw-bold">Akses Akun</h5>
                        <p class="text-muted small mb-0">Buat dan kelola akun login sistem untuk karyawan.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>