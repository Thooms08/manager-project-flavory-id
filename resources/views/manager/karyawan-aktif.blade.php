<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Aktif | Key.Flavory.id</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
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
            padding: 0.5rem 1.25rem;
            transition: all 0.3s ease;
        } 
        .btn-orange:hover { 
            background: var(--orange-hover); 
            color: white; 
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(253, 126, 20, 0.2);
        }

        .table-custom-wrapper {
            background: #fff; 
            border-radius: 16px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
            border: 1px solid #f1f5f9;
            overflow: hidden;
        }
        .table-custom th {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: #64748b;
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 1rem 1.5rem;
        }
        .table-custom td {
            vertical-align: middle;
            padding: 1rem 1.5rem;
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

        .badge-status {
            padding: 0.4em 0.8em;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
        }

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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="{{ route('manager.karyawan.index') }}" class="navbar-brand fw-bold text-dark d-flex align-items-center">
                <i class="bi bi-arrow-left-short fs-4 me-2"></i> Karyawan Aktif
            </a>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        @if(session('success')) 
            <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center mb-4">
                <i class="bi bi-check-circle-fill fs-5 me-3"></i> {{ session('success') }}
            </div> 
        @endif

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold m-0 text-dark">Daftar Karyawan Aktif</h4>
                <p class="text-muted small m-0 mt-1">Kelola data operasional karyawan yang sedang berjalan.</p>
            </div>
            <button class="btn btn-orange shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Karyawan
            </button>
        </div>

        <div class="table-custom-wrapper">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Karyawan</th>
                            <th>Kontak</th>
                            <th>Tanggal Masuk</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($karyawans as $k)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle">{{ strtoupper(substr($k->nama, 0, 1)) }}</div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $k->nama }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">{{ $k->jabatan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="mb-1 small"><i class="bi bi-envelope text-muted me-2"></i>{{ $k->email }}</span>
                                    <span class="small"><i class="bi bi-telephone text-muted me-2"></i>{{ $k->no_tlp }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium">{{ \Carbon\Carbon::parse($k->tgl_masuk)->format('d M Y') }}</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">{{ $k->jenis_karyawan }}</div>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success badge-status border border-success border-opacity-25">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Aktif
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $k->id }}" title="Detail"><i class="bi bi-eye"></i></button>
                                    <button class="btn btn-sm btn-light border text-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                    <form action="{{ route('manager.karyawan.nonaktifkan', $k->id) }}" method="POST" class="d-inline form-nonaktif">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light border text-danger" title="Nonaktifkan"><i class="bi bi-power"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailModal{{ $k->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header border-bottom-0 pb-0">
                                        <h5 class="modal-title fw-bold">Detail Profil</h5>
                                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center mb-4">
                                            <div class="avatar-circle mx-auto mb-2" style="width: 70px; height: 70px; font-size: 2rem;">{{ strtoupper(substr($k->nama, 0, 1)) }}</div>
                                            <h5 class="fw-bold mb-0">{{ $k->nama }}</h5>
                                            <p class="text-muted small">{{ $k->jabatan }} - {{ $k->jenis_karyawan }}</p>
                                        </div>
                                        <div class="bg-light p-3 rounded-3 mb-3">
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Jabatan</div>
                                                <div class="col-7 fw-bold text-end text-orange">{{ $k->jabatan }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Jenis Karyawan</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->jenis_karyawan }}</div>
                                            </div>
                                            <hr class="my-2 opacity-10">
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">No WhatsApp</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->no_tlp }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Pendidikan</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->pendidikan_terakhir }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Tgl Masuk</div>
                                                <div class="col-7 fw-medium text-end">{{ \Carbon\Carbon::parse($k->tgl_masuk)->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            @if($k->ktp) <a href="{{ asset($k->ktp) }}" target="_blank" class="btn btn-outline-primary w-100 btn-sm"><i class="bi bi-person-badge"></i> KTP</a> @endif
                                            @if($k->cv) <a href="{{ asset($k->cv) }}" target="_blank" class="btn btn-outline-success w-100 btn-sm"><i class="bi bi-file-earmark-pdf"></i> CV</a> @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content border-0 shadow">
                                    <form action="{{ route('manager.karyawan.update', $k->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-header"><h5 class="modal-title fw-bold">Edit Karyawan</h5><button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button></div>
                                        <div class="modal-body bg-light">
                                            <div class="bg-white p-4 rounded-3 border">
                                                <div class="row g-3">
                                                    <div class="col-md-6"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ $k->email }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Jabatan</label><input type="text" name="jabatan" class="form-control" value="{{ $k->jabatan }}" placeholder="Contoh: Barista" required></div>
                                                    <div class="col-md-6"><label class="form-label">Jenis Karyawan</label><input type="text" name="jenis_karyawan" class="form-control" value="{{ $k->jenis_karyawan }}" placeholder="Contoh: Tetap" required></div>
                                                    <div class="col-md-6"><label class="form-label">No WhatsApp</label><input type="text" name="no_tlp" class="form-control" value="{{ $k->no_tlp }}" required></div>
                                                    <div class="col-md-6"><label class="form-label">Tgl Masuk</label><input type="date" name="tgl_masuk" class="form-control" value="{{ $k->tgl_masuk }}" required></div>
                                                    <div class="col-md-12"><label class="form-label">Pendidikan Terakhir</label><input type="text" name="pendidikan_terakhir" class="form-control" value="{{ $k->pendidikan_terakhir }}" required></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer"><button type="submit" class="btn btn-orange px-4">Simpan Perubahan</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="5" class="text-center py-5">Belum ada data karyawan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <form action="{{ route('manager.karyawan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header"><h5 class="modal-title fw-bold">Tambah Karyawan Baru</h5><button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body bg-light">
                        <div class="bg-white p-4 rounded-3 border">
                            <div class="row g-4">
                                <div class="col-md-12"><label class="form-label">Nama Lengkap</label><input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required></div>
                                <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" id="ajaxEmail" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label">No. WhatsApp</label><input type="number" name="no_tlp" id="ajaxPhone" class="form-control" required></div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control" placeholder="Contoh: Waiters, Kasir, Barista" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenis Karyawan</label>
                                    <input type="text" name="jenis_karyawan" class="form-control" placeholder="Contoh: Kontrak, Tetap, Part Time" required>
                                </div>
                                
                                <div class="col-md-6"><label class="form-label">Tgl Lahir</label><input type="date" name="tgl_lahir" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label">Pendidikan Terakhir</label><input type="text" name="pendidikan_terakhir" class="form-control" placeholder="Contoh: SMA/S1" required></div>
                                <div class="col-md-12"><label class="form-label">Tanggal Masuk</label><input type="date" name="tgl_masuk" class="form-control" required></div>
                                <div class="col-md-6"><label class="form-label">Upload KTP</label><input type="file" name="ktp" class="form-control" accept=".jpg,.jpeg,.png"></div>
                                <div class="col-md-6"><label class="form-label">Upload CV</label><input type="file" name="cv" class="form-control" accept=".pdf,.jpg,.jpeg,.png"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-orange px-4">Simpan Data</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>