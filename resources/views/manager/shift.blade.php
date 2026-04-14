<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Shift | Key.Flavory.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding-top: 80px; }
        .navbar-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
        .btn-orange { background: #fd7e14; color: white; border-radius: 8px; font-weight: 500;}
        .btn-orange:hover { background: #e86c00; color: white; }
        .shift-card { border: none; border-radius: 12px; transition: transform 0.2s; cursor: pointer; text-decoration: none;}
        .shift-card:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3 border-bottom">
        <div class="container">
            <a href="{{ route('manager.index') }}" class="navbar-brand fw-bold text-dark"><i class="bi bi-arrow-left me-2"></i> Manajemen Shift</a>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success')) <div class="alert alert-success border-0 shadow-sm rounded-3">{{ session('success') }}</div> @endif
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-0">Daftar Shift Karyawan</h4>
                <p class="text-muted small">Kelola jam kerja dan rotasi karyawan Anda.</p>
            </div>
            <button class="btn btn-orange shadow-sm" data-bs-toggle="modal" data-bs-target="#modalShift">
                <i class="bi bi-plus-lg"></i> Shift Baru
            </button>
        </div>

        <div class="row g-4">
            @forelse($shifts as $s)
            <div class="col-md-4">
                <a href="{{ route('manager.shift.detail', $s->uuid) }}" class="card shift-card h-100 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 me-3">
                                <i class="bi bi-clock-history fs-3"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-0">{{ $s->shift }}</h5>
                        </div>
                        <p class="text-muted small mb-0"><i class="bi bi-people-fill me-1"></i> {{ $s->members_count }} Karyawan ditugaskan</p>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-calendar-x fs-1 text-muted opacity-50 mb-3 d-block"></i>
                <h6 class="text-muted">Belum ada kategori shift.</h6>
            </div>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="modalShift" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('manager.shift.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-bottom-0"><h5 class="modal-title fw-bold">Tambah Kategori Shift</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <label class="form-label">Nama Shift</label>
                        <input type="text" name="shift" class="form-control" placeholder="Contoh: SHIFT PAGI" required>
                    </div>
                    <div class="modal-footer border-top-0"><button type="submit" class="btn btn-orange w-100">Simpan Shift</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>