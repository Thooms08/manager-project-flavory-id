<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan Nonaktif | Key.Flavory.id</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    
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

        .avatar-circle.nonaktif {
            background-color: #fef2f2;
            color: #ef4444;
        }

        .badge-status {
            padding: 0.4em 0.8em;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.8rem;
        }

        /* Custom styling untuk SweetAlert agar font sesuai */
        .swal2-title, .swal2-html-container {
            font-family: 'Inter', sans-serif !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3">
        <div class="container">
            <a href="{{ route('manager.karyawan.index') }}" class="navbar-brand fw-bold text-dark d-flex align-items-center">
                <i class="bi bi-arrow-left-short fs-4 me-2"></i> Karyawan Nonaktif
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
                <h4 class="fw-bold m-0 text-dark">Arsip Karyawan Nonaktif</h4>
                <p class="text-muted small m-0 mt-1">Daftar mantan karyawan atau anggota tim yang sedang dinonaktifkan sementara.</p>
            </div>
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
                                    <div class="avatar-circle nonaktif">{{ strtoupper(substr($k->nama, 0, 1)) }}</div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $k->nama }}</div>
                                        <div class="text-muted small" style="font-size: 0.75rem;">{{ $k->jabatan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="mb-1"><i class="bi bi-envelope text-muted me-2"></i>{{ $k->email }}</span>
                                    <span><i class="bi bi-telephone text-muted me-2"></i>{{ $k->no_tlp }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="fw-medium">{{ \Carbon\Carbon::parse($k->tgl_masuk)->format('d M Y') }}</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">
                                    {{ $k->jenis_karyawan }}
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-danger bg-opacity-10 text-danger badge-status border border-danger border-opacity-25">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem; vertical-align: middle;"></i> Nonaktif
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group shadow-sm">
                                    <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $k->id }}" title="Detail Profil">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    
                                    <form action="{{ route('manager.karyawan.aktifkan', $k->id) }}" method="POST" class="d-inline form-aktifkan">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light border text-success" title="Aktifkan Kembali">
                                            <i class="bi bi-person-check-fill"></i>
                                        </button>
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
                                            <div class="avatar-circle nonaktif mx-auto mb-2" style="width: 70px; height: 70px; font-size: 2rem;">
                                                {{ strtoupper(substr($k->nama, 0, 1)) }}
                                            </div>
                                            <h5 class="fw-bold mb-0">{{ $k->nama }}</h5>
                                            <p class="text-muted small">{{ $k->jabatan }} - {{ $k->jenis_karyawan }}</p>
                                        </div>
                                        <div class="bg-light p-3 rounded-3 mb-3">
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Jabatan</div>
                                                <div class="col-7 fw-bold text-end text-danger">{{ $k->jabatan }}</div>
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
                                                <div class="col-5 text-muted small">Tgl Lahir</div>
                                                <div class="col-7 fw-medium text-end">{{ \Carbon\Carbon::parse($k->tgl_lahir)->format('d M Y') }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Pendidikan</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->pendidikan_terakhir }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Domisili</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->domisili ?? '-' }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-5 text-muted small">Alamat (KTP)</div>
                                                <div class="col-7 fw-medium text-end">{{ $k->alamat ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            @if($k->ktp) 
                                                <a href="{{ asset($k->ktp) }}" target="_blank" class="btn btn-outline-primary w-100 btn-sm"><i class="bi bi-person-badge"></i> Lihat KTP</a> 
                                            @endif
                                            @if($k->cv) 
                                                <a href="{{ asset($k->cv) }}" target="_blank" class="btn btn-outline-success w-100 btn-sm"><i class="bi bi-file-earmark-pdf"></i> Lihat CV</a> 
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-archive fs-1 d-block mb-3 opacity-50"></i>
                                    <h5>Tidak ada arsip karyawan nonaktif</h5>
                                    <p class="small">Semua data karyawan Anda saat ini berstatus aktif.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Script Konfirmasi SweetAlert untuk Mengaktifkan Karyawan
            const formAktifkan = document.querySelectorAll('.form-aktifkan');
            
            formAktifkan.forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault(); // Mencegah form langsung submit
                    
                    Swal.fire({
                        title: 'Aktifkan Karyawan?',
                        text: "Karyawan ini akan dikembalikan ke daftar aktif.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#198754', // Warna hijau (success) agar selaras dengan aksi aktif
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Ya, Aktifkan!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true // Membalik posisi tombol
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit jika user klik 'Ya'
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>