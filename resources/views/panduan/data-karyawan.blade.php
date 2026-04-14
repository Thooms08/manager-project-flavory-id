@extends('layouts.app')

@section('title', 'Panduan Mengelola Data Karyawan di Key.Flavory.id (Manager)')

@section('meta')
    <meta name="description" content="Panduan lengkap untuk Manager/Owner dalam mengelola data karyawan aktif, karyawan nonaktif, dan pembuatan akses akun sistem manajemen karyawan Key.Flavory.id.">
    <meta name="keywords" content="data karyawan kasir, kelola karyawan flavory, manajemen karyawan key flavory, panduan hrms, aplikasi sdm">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-bg: #f8f9fa;
        --kf-text: #343a40;
    }

    body {
        background-color: var(--kf-bg);
        color: var(--kf-text);
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }

    /* Card Styling */
    .guide-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.04);
        margin-bottom: 2rem;
        overflow: hidden;
    }
    
    .card-header-orange {
        background: linear-gradient(90deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-bottom: none;
    }

    /* Numbered Steps */
    .step-list {
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
    }
    
    .step-list li {
        position: relative;
        padding-left: 45px;
        margin-bottom: 1.5rem;
    }
    
    .step-list li:last-child {
        margin-bottom: 0;
    }
    
    .step-number {
        position: absolute;
        left: 0;
        top: -2px;
        width: 32px;
        height: 32px;
        background-color: var(--kf-orange-light);
        color: var(--kf-orange-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        border: 2px solid var(--kf-orange);
    }

    /* Highlight Box */
    .highlight-box {
        background-color: #fff9f2;
        border-left: 5px solid var(--kf-orange);
        padding: 1.5rem;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(253, 126, 20, 0.1);
    }

    /* Custom Table Illustration */
    .table-illustration {
        font-size: 0.9rem;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }
    .table-illustration thead { background-color: #f1f3f5; }

    /* Badge Custom */
    .badge-orange {
        background-color: var(--kf-orange-light);
        color: var(--kf-orange-dark);
        border: 1px solid var(--kf-orange);
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

            <nav aria-label="breadcrumb" class="mb-4 d-none d-md-block">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-muted">Panduan</a></li>
                    <li class="breadcrumb-item active text-orange fw-bold" aria-current="page">Manajemen Karyawan</li>
                </ol>
            </nav>

            <header class="text-center mb-5 pb-3 border-bottom">
                <div class="d-inline-block bg-orange text-white rounded-circle p-3 mb-3 shadow-sm">
                    <i class="bi bi-people-fill fs-1"></i>
                </div>
                <h1 class="fw-bold h2 mb-3">Panduan Mengelola Data Karyawan di <span class="text-orange">Key.Flavory.id</span></h1>
                <p class="lead text-muted mx-auto" style="max-width: 800px;">
                    Sebagai Manager/Owner, langkah pertama setelah login adalah melakukan konfigurasi profil staf Anda. 
                    Kelola data karyawan kasir, admin, maupun operasional dengan baik sebelum menggunakan seluruh fitur sistem secara optimal.
                </p>
            </header>

            <main>
                <section class="mb-5 text-center">
                    <p class="fs-5">Untuk memulai, silakan klik menu atau card <strong class="text-orange"><i class="bi bi-folder2-open me-2"></i>Data Karyawan</strong> pada Dashboard utama Anda. Di halaman tersebut, Anda akan menemukan 3 bagian utama pengelolaan.</p>
                </section>

                <section id="karyawan-aktif">
                    <article class="card guide-card">
                        <div class="card-header-orange d-flex align-items-center">
                            <i class="bi bi-person-check fs-4 me-2"></i>
                            <h2 class="h5 fw-bold mb-0">1. Menambahkan Data Karyawan (Karyawan Aktif)</h2>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4 mb-lg-0">
                                    <ul class="step-list">
                                        <li>
                                            <div class="step-number">1</div>
                                            <h3 class="h6 fw-bold mb-1">Masuk ke Tab Karyawan Aktif</h3>
                                            <p class="text-muted small">Pilih bagian Karyawan Aktif pada menu navigasi.</p>
                                        </li>
                                        <li>
                                            <div class="step-number">2</div>
                                            <h3 class="h6 fw-bold mb-1">Tambah Karyawan Baru</h3>
                                            <p class="text-muted small">Klik tombol <span class="badge bg-orange text-white"><i class="bi bi-plus-lg"></i> Tambah Karyawan</span> yang tersedia di pojok kanan atas.</p>
                                        </li>
                                        <li>
                                            <div class="step-number">3</div>
                                            <h3 class="h6 fw-bold mb-1">Lengkapi Formulir Data</h3>
                                            <p class="text-muted small">Isi form data diri karyawan. Perhatikan kolom wajib (ditandai dengan bintang) dan kolom opsional.</p>
                                        </li>
                                        <li>
                                            <div class="step-number">4</div>
                                            <h3 class="h6 fw-bold mb-1">Penonaktifan Karyawan</h3>
                                            <p class="text-muted small">Jika karyawan sudah tidak bekerja atau *resign*, Anda cukup menekan tombol <strong>Nonaktifkan</strong> pada kolom aksi di tabel.</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="table-responsive table-illustration shadow-sm">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nama Karyawan</th>
                                                    <th>Posisi</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-end">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><div class="fw-bold text-dark">Budi Santoso</div><small class="text-muted">budi@email.com</small></td>
                                                    <td class="align-middle">Kasir</td>
                                                    <td class="align-middle text-center"><span class="badge bg-success">Aktif</span></td>
                                                    <td class="align-middle text-end">
                                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-person-dash"></i> Nonaktifkan</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="fw-bold text-dark">Siti Aminah</div><small class="text-muted">siti@email.com</small></td>
                                                    <td class="align-middle">Staff Dapur</td>
                                                    <td class="align-middle text-center"><span class="badge bg-success">Aktif</span></td>
                                                    <td class="align-middle text-end">
                                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-person-dash"></i> Nonaktifkan</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>

                <section id="karyawan-nonaktif">
                    <article class="card guide-card">
                        <div class="card-header-orange bg-secondary d-flex align-items-center" style="background: linear-gradient(90deg, #6c757d 0%, #495057 100%);">
                            <i class="bi bi-person-x fs-4 me-2"></i>
                            <h2 class="h5 fw-bold mb-0 text-white">2. Mengelola Karyawan Nonaktif</h2>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <p class="text-muted mb-4">Data karyawan yang sudah *resign* atau diberhentikan tidak akan dihapus dari sistem untuk keperluan riwayat (history), melainkan dipindah ke daftar Nonaktif.</p>
                            
                            <ul class="step-list mb-0">
                                <li>
                                    <div class="step-number" style="border-color: #6c757d; color: #6c757d; background: #e9ecef;">1</div>
                                    <h3 class="h6 fw-bold mb-1">Masuk ke Tab Karyawan Nonaktif</h3>
                                    <p class="text-muted small">Lihat daftar histori karyawan yang telah dinonaktifkan di bagian ini.</p>
                                </li>
                                <li>
                                    <div class="step-number" style="border-color: #6c757d; color: #6c757d; background: #e9ecef;">2</div>
                                    <h3 class="h6 fw-bold mb-1">Mengaktifkan Kembali</h3>
                                    <p class="text-muted small">Jika karyawan tersebut kembali bekerja, Anda tidak perlu membuat data baru. Cukup klik tombol <strong class="text-success"><i class="bi bi-arrow-counterclockwise"></i> Aktifkan</strong> pada kolom aksi untuk memulihkan statusnya.</p>
                                </li>
                            </ul>
                        </div>
                    </article>
                </section>

                <section id="akses-akun">
                    <article class="card guide-card border-orange">
                        <div class="card-header-orange d-flex align-items-center">
                            <i class="bi bi-key fs-4 me-2"></i>
                            <h2 class="h5 fw-bold mb-0">3. Membuat Akun untuk Karyawan</h2>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <div class="row">
                                <div class="col-md-7">
                                    <ul class="step-list mb-4 mb-md-0">
                                        <li>
                                            <div class="step-number">1</div>
                                            <h3 class="h6 fw-bold mb-1">Masuk ke Bagian Akses Akun</h3>
                                            <p class="text-muted small">Pilih menu Akses Akun untuk mulai memberikan hak akses masuk sistem kepada staf Anda.</p>
                                        </li>
                                        <li>
                                            <div class="step-number">2</div>
                                            <h3 class="h6 fw-bold mb-1">Pilih Karyawan</h3>
                                            <p class="text-muted small">Cari dan pilih nama karyawan aktif yang ingin dibuatkan akun dari daftar dropdown.</p>
                                        </li>
                                        <li>
                                            <div class="step-number">3</div>
                                            <h3 class="h6 fw-bold mb-1">Atur Username & Password</h3>
                                            <p class="text-muted small">Buat <em>Username</em> unik dan <em>Password</em> yang aman. Kredensial ini akan digunakan karyawan untuk login ke dashboard karyawan.</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-5">
                                    <div class="bg-light p-4 rounded-3 h-100 border d-flex flex-column justify-content-center text-center">
                                        <i class="bi bi-shield-lock text-orange display-4 mb-3"></i>
                                        <h4 class="h6 fw-bold">Hak Akses Sistem</h4>
                                        <p class="small text-muted mb-0">Akun yang Anda buat di sini adalah satu-satunya cara bagi karyawan untuk masuk ke sistem Key.Flavory.id secara mandiri.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>

                <section class="mt-4">
                    <div class="highlight-box d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill text-orange fs-1 me-4 d-none d-sm-block"></i>
                        <div>
                            <h3 class="h5 fw-bold mb-2">Catatan Penting Manager</h3>
                            <p class="mb-0 text-muted">
                                Pastikan seluruh data karyawan diinput dengan <strong>benar dan akurat</strong>. Kesalahan input data, seperti email atau jadwal shift, dapat menyebabkan proses akses login dan operasional manajemen SDM harian menjadi terhambat.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="text-center mt-5 pt-4 border-top">
                    <a href="{{ url('/manager/karyawan') }}" class="btn btn-lg btn-orange px-5 shadow-sm rounded-pill">
                        <i class="bi bi-gear-fill me-2"></i> Mulai Kelola Karyawan
                    </a>
                </section>

            </main>

        </div> </div> </div> 

@endsection