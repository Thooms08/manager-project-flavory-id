@extends('layouts.app')

@section('title', 'Panduan Melihat Rekap Absensi Karyawan - Key.Flavory.id')

@section('meta')
    <meta name="description" content="Pelajari cara melihat rekap absensi karyawan, memantau kehadiran, dan mengekspor data laporan ke Excel di platform HRMS Key.Flavory.id.">
    <meta name="keywords" content="rekap absensi karyawan, absensi kasir, monitor kehadiran karyawan, laporan absensi hrms, export absensi excel">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-soft-gray: #f8f9fa;
    }

    body {
        background-color: var(--kf-soft-gray);
        color: #333;
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }
    
    .card-guide {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }

    .step-badge {
        width: 35px;
        height: 35px;
        background-color: var(--kf-orange);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .table-illustration {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .table-illustration thead {
        background-color: var(--kf-orange-light);
    }

    .highlight-tips {
        background-color: #fff9f0;
        border-left: 5px solid var(--kf-orange);
        border-radius: 8px;
        padding: 20px;
    }

    .btn-export-mockup {
        background-color: #198754;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .icon-box {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
    }

    /* SEO Friendly Spacing */
    section { padding: 40px 0; }
    header { padding: 60px 0 40px 0; }

    @media (max-width: 768px) {
        .display-5 { font-size: 1.8rem; }
        .icon-box { font-size: 2rem; }
    }

    /* Layout Adjustments untuk Sidebar */
    .documentation-container {
        max-width: 1400px;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid documentation-container py-5 px-xl-5">
    
    <div class="row g-5">
        
        <div class="col-lg-3 d-none d-lg-block">
            <div class="position-sticky" style="top: 100px;">
                @include('panduan.sidebar')
            </div>
        </div>

        <div class="col-lg-9 col-12">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item"><a href="/panduan" class="text-decoration-none text-muted">Panduan</a></li>
                    <li class="breadcrumb-item active text-orange" aria-current="page">Rekap Absensi</li>
                </ol>
            </nav>

            <header class="text-center">
                <div class="icon-box text-orange">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </div>
                <h1 class="display-5 fw-bold mb-3">Panduan Melihat Rekap Absensi Karyawan</h1>
                <p class="lead text-muted mx-auto" style="max-width: 800px;">
                    Setelah jadwal shift karyawan diatur dengan rapi di <strong>Key.Flavory.id</strong>, langkah krusial selanjutnya adalah memantau kehadiran mereka secara *real-time* melalui fitur Rekap Absensi.
                </p>
            </header>

            <main>
                <section id="akses-menu">
                    <article class="card card-guide p-4 p-md-5">
                        <div class="row align-items-center">
                            <div class="col-lg-7">
                                <h2 class="h3 fw-bold mb-4">Cara Mengakses Rekap Absensi</h2>
                                <ul class="list-unstyled">
                                    <li class="d-flex align-items-start mb-4">
                                        <div class="step-badge">1</div>
                                        <div>
                                            <h3 class="h6 fw-bold mb-1">Buka Dashboard Manager</h3>
                                            <p class="text-muted mb-0">Login ke akun Manager/Owner Anda dan temukan menu atau card bertuliskan <strong class="text-orange">"Rekap Absensi"</strong>.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start mb-4">
                                        <div class="step-badge">2</div>
                                        <div>
                                            <h3 class="h6 fw-bold mb-1">Masuk ke Halaman Laporan</h3>
                                            <p class="text-muted mb-0">Klik menu tersebut, dan Anda akan diarahkan ke halaman utama laporan kehadiran karyawan.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <div class="step-badge">3</div>
                                        <div>
                                            <h3 class="h6 fw-bold mb-1">Pantau Seluruh Data</h3>
                                            <p class="text-muted mb-0">Halaman ini secara otomatis menampilkan data kehadiran, keterlambatan, dan status absen seluruh karyawan Anda.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-5 text-center d-none d-lg-block">
                                <i class="bi bi-person-bounding-box text-orange opacity-25" style="font-size: 10rem;"></i>
                            </div>
                        </div>
                    </article>
                </section>

                <section id="fitur-utama">
                    <h2 class="h3 fw-bold text-center mb-5">Fitur Pengelolaan Laporan</h2>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <article class="card card-guide h-100 p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-calendar3 text-orange fs-4 me-3"></i>
                                    <h3 class="h5 fw-bold mb-0">1. Melihat Detail Absensi</h3>
                                </div>
                                <p class="text-muted small">Untuk mendapatkan informasi lebih mendalam per individu, silakan klik <strong>ikon kalender</strong> yang tersedia pada kolom detail di baris nama karyawan.</p>
                                <div class="mt-auto pt-3 text-center bg-light rounded py-3">
                                    <i class="bi bi-calendar-check text-success h1 mb-0"></i>
                                    <p class="small text-muted mt-2 mb-0">Tampilan kalender kehadiran rinci</p>
                                </div>
                            </article>
                        </div>

                        <div class="col-md-6">
                            <article class="card card-guide h-100 p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-file-earmark-excel text-success fs-4 me-3"></i>
                                    <h3 class="h5 fw-bold mb-0">2. Export Data ke Excel</h3>
                                </div>
                                <p class="text-muted small">Gunakan data absensi untuk keperluan penggajian atau arsip offline dengan mengekspor laporan ke format file Excel.</p>
                                <div class="mt-auto pt-3 text-center">
                                    <button class="btn-export-mockup w-100 shadow-sm">
                                        <i class="bi bi-download me-2"></i> Export Excel
                                    </button>
                                    <p class="small text-muted mt-2 mb-0">Format file siap olah (.xlsx)</p>
                                </div>
                            </article>
                        </div>
                    </div>
                </section>

                <section id="ilustrasi-data">
                    <h2 class="h4 fw-bold mb-4">Ilustrasi Tampilan Rekap</h2>
                    <div class="table-responsive shadow-sm rounded-3">
                        <table class="table table-hover table-illustration mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Karyawan</th>
                                    <th>Hadir</th>
                                    <th>Terlambat</th>
                                    <th>Izin/Sakit</th>
                                    <th class="text-center pe-4">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 fw-bold">Budi Santoso</td>
                                    <td>24 Hari</td>
                                    <td class="text-danger">2 Hari</td>
                                    <td>0</td>
                                    <td class="text-center pe-4"><i class="bi bi-calendar3 text-orange cursor-pointer"></i></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-bold">Siti Aminah</td>
                                    <td>26 Hari</td>
                                    <td class="text-success">0 Hari</td>
                                    <td>0</td>
                                    <td class="text-center pe-4"><i class="bi bi-calendar3 text-orange cursor-pointer"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="tips-manager">
                    <aside class="highlight-tips">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center d-none d-md-block">
                                <i class="bi bi-lightbulb text-orange fs-1"></i>
                            </div>
                            <div class="col-md-11">
                                <h3 class="h5 fw-bold mb-2">Tips Pengelolaan Bisnis:</h3>
                                <p class="mb-0 text-muted">Gunakan fitur Rekap Absensi secara rutin setiap minggu atau bulan untuk <strong>memantau kedisiplinan karyawan</strong> dan memastikan jadwal operasional bisnis berjalan sesuai dengan rencana yang telah Anda tetapkan.</p>
                            </div>
                        </div>
                    </aside>
                </section>

                <section class="text-center mt-4 pb-5">
                    <p class="text-muted mb-4">Siap untuk memantau performa tim Anda hari ini?</p>
                    <a href="{{ url('/manager/rekap-absensi') }}" class="btn btn-orange btn-lg px-5 shadow rounded-pill text-white fw-bold">
                        Buka Dashboard Absensi <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </section>
            </main>

        </div> </div> </div> 

@endsection