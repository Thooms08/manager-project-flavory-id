@extends('layouts.app')

@section('title', 'Panduan Log In Key.Flavory.id - Akses Manager & Karyawan')

@section('meta')
    <meta name="description" content="Pelajari langkah-langkah log in di Key.Flavory.id. Panduan akses dashboard manager dan cara aktivasi akun karyawan menggunakan Manager Key.">
    <meta name="keywords" content="login key flavory, login kasir karyawan, akses manager key flavory, cara login hrms, manajemen karyawan flavory">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-gray-bg: #f8f9fa;
    }

    body {
        background-color: var(--kf-gray-bg);
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }

    /* Tab Styling */
    .nav-pills .nav-link {
        color: #495057;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px 25px;
        transition: 0.3s;
    }
    .nav-pills .nav-link.active {
        background-color: var(--kf-orange);
        box-shadow: 0 4px 15px rgba(253, 126, 20, 0.3);
    }
    .nav-pills .nav-link:hover:not(.active) {
        background-color: var(--kf-orange-light);
        color: var(--kf-orange);
    }

    /* Card Styling */
    .guide-card {
        border: none;
        border-radius: 15px;
        background: #ffffff;
    }
    .step-item {
        position: relative;
        padding-left: 50px;
        margin-bottom: 25px;
    }
    .step-number {
        position: absolute;
        left: 0;
        top: 0;
        width: 35px;
        height: 35px;
        background-color: var(--kf-orange);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    /* Highlight Box */
    .info-box {
        background-color: var(--kf-orange-light);
        border-left: 5px solid var(--kf-orange);
        padding: 20px;
        border-radius: 10px;
    }

    .btn-orange {
        background-color: var(--kf-orange);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-orange:hover {
        background-color: var(--kf-orange-dark);
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .nav-pills .nav-link { padding: 10px; font-size: 0.9rem; }
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

            <header class="text-center mb-5">
                <h1 class="fw-bold mb-3">Panduan Log In di <span class="text-orange">Key.Flavory.id</span></h1>
                <p class="lead text-muted mx-auto" style="max-width: 800px;">
                    Setelah berhasil melakukan pendaftaran di <strong>Key.Flavory.id</strong>, Anda dapat mengakses dashboard sistem sesuai dengan peran (role) masing-masing. Silakan pilih panduan berdasarkan tipe akun Anda.
                </p>
            </header>

            <main>
                <ul class="nav nav-pills justify-content-center mb-5 gap-2" id="loginTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active shadow-sm" id="manager-tab" data-bs-toggle="pill" data-bs-target="#manager-content" type="button" role="tab" aria-controls="manager-content" aria-selected="true">
                            <i class="bi bi-person-badge me-2"></i>Manager / Owner
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link shadow-sm" id="karyawan-tab" data-bs-toggle="pill" data-bs-target="#karyawan-content" type="button" role="tab" aria-controls="karyawan-content" aria-selected="false">
                            <i class="bi bi-people me-2"></i>Karyawan
                        </button>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="loginTabContent">
                    
                    <section class="tab-pane fade show active" id="manager-content" role="tabpanel" aria-labelledby="manager-tab">
                        <article class="card guide-card shadow-sm p-4 p-md-5">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <h2 class="h3 fw-bold mb-4">Log In sebagai Manager/Owner</h2>
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <h3 class="h6 fw-bold">Pilih Jenis Akses</h3>
                                        <p class="text-muted">Buka halaman utama login dan pastikan Anda memilih opsi akses bertanda <strong class="text-orange">“Manager”</strong>.</p>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <h3 class="h6 fw-bold">Masukkan Kredensial</h3>
                                        <p class="text-muted">Masukkan <strong>Username</strong> dan <strong>Password</strong> yang telah Anda buat saat melakukan proses pendaftaran sebelumnya.</p>
                                    </div>
                                    <div class="step-item mb-0">
                                        <div class="step-number">3</div>
                                        <h3 class="h6 fw-bold">Masuk ke Dashboard</h3>
                                        <p class="text-muted">Klik tombol login. Jika data benar, Anda akan langsung diarahkan ke Dashboard utama Manager untuk mengelola operasional HRMS.</p>
                                    </div>
                                </div>
                                <div class="col-lg-5 d-none d-lg-block text-center">
                                    <i class="bi bi-shield-lock-fill text-orange" style="font-size: 10rem; opacity: 0.1;"></i>
                                </div>
                            </div>
                        </article>
                    </section>

                    <section class="tab-pane fade" id="karyawan-content" role="tabpanel" aria-labelledby="karyawan-tab">
                        <div class="row g-4">
                            <article class="col-md-6">
                                <div class="card h-100 guide-card shadow-sm p-4">
                                    <h2 class="h4 fw-bold mb-4 d-flex align-items-center">
                                        <span class="bg-orange text-white rounded-circle p-2 me-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; font-size:1rem;">A</span>
                                        Sudah Memiliki Akun
                                    </h2>
                                    <div class="step-item">
                                        <div class="step-number">1</div>
                                        <p class="mb-0 text-muted">Pilih opsi <strong class="text-orange">“Sudah punya akun”</strong> pada halaman login karyawan.</p>
                                    </div>
                                    <div class="step-item">
                                        <div class="step-number">2</div>
                                        <p class="mb-0 text-muted">Masukkan username dan password yang telah didaftarkan atau diberikan oleh Manager/Owner.</p>
                                    </div>
                                    <div class="step-item mb-0">
                                        <div class="step-number">3</div>
                                        <p class="mb-0 text-muted">Klik login untuk masuk ke dashboard karyawan Anda.</p>
                                    </div>
                                </div>
                            </article>

                            <article class="col-md-6">
                                <div class="card h-100 guide-card shadow-sm p-4">
                                    <h2 class="h4 fw-bold mb-4 d-flex align-items-center">
                                        <span class="bg-orange text-white rounded-circle p-2 me-3" style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; font-size:1rem;">B</span>
                                        Belum Memiliki Akun
                                    </h2>
                                    <div class="step-item mb-3">
                                        <div class="step-number">1</div>
                                        <p class="mb-0 text-muted">Pilih opsi <strong class="text-orange">“Belum punya akun”</strong> pada menu login.</p>
                                    </div>
                                    <div class="step-item mb-3">
                                        <div class="step-number">2</div>
                                        <p class="mb-0 text-muted">Masukkan <strong>Manager Key</strong>. Kode ini didapatkan dari dashboard Manager perusahaan Anda.</p>
                                    </div>
                                    <div class="step-item mb-3">
                                        <div class="step-number">3</div>
                                        <p class="mb-0 text-muted">Masukkan email yang telah didaftarkan oleh pihak perusahaan.</p>
                                    </div>
                                    <div class="step-item mb-0">
                                        <div class="step-number">4</div>
                                        <p class="mb-0 text-muted">Jika data valid, silakan buat username dan password baru untuk akun Anda.</p>
                                    </div>
                                </div>
                            </article>

                            <div class="col-12">
                                <aside class="info-box shadow-sm">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-info-circle-fill text-orange fs-3 me-3"></i>
                                        <div>
                                            <h4 class="h6 fw-bold mb-1 text-uppercase">Tentang Manager Key</h4>
                                            <p class="mb-0 small text-muted">Manager Key adalah kode otentikasi unik untuk menghubungkan akun karyawan dengan perusahaan. Kode ini hanya tersedia di halaman dashboard Manager/Owner.</p>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </section>
                </div>

                <section class="mt-5 py-4 border-top">
                    <div class="row align-items-center text-center text-md-start">
                        <div class="col-md-8">
                            <h4 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>Catatan Penting</h4>
                            <p class="text-muted mb-0">Pastikan data yang dimasukkan sesuai dengan data terdaftar agar proses login berjalan lancar tanpa kendala teknis.</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-4 mt-md-0">
                            <a href="/login" class="btn btn-orange shadow-sm">
                                Ke Halaman Login <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </main>

        </div> </div> </div>

@endsection