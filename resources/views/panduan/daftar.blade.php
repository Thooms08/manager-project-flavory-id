@extends('layouts.app')

@section('title', 'Panduan Pendaftaran Key Flavory - Cara Daftar Aplikasi HRMS')

@section('meta')
    <meta name="description" content="Pelajari langkah mudah pendaftaran di Key.Flavory.id. Panduan lengkap cara daftar aplikasi HRMS dan sistem manajemen karyawan dengan biaya pendaftaran Rp88.000 sekali bayar.">
    <meta name="keywords" content="daftar key flavory, cara daftar aplikasi hrms, pendaftaran key flavory id, panduan registrasi hrms, sistem manajemen sdm, human resource management system">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }
    .btn-orange { 
        background-color: var(--kf-orange); 
        color: white; 
        border: none;
        transition: 0.3s;
    }
    .btn-orange:hover { 
        background-color: var(--kf-orange-dark); 
        color: white; 
        transform: translateY(-2px);
    }

    .guide-card {
        border: none;
        border-radius: 15px;
        transition: 0.3s;
    }
    .guide-card:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .step-number {
        width: 40px;
        height: 40px;
        background-color: var(--kf-orange);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .highlight-box {
        background-color: var(--kf-orange-light);
        border-left: 5px solid var(--kf-orange);
        border-radius: 8px;
    }

    .verification-section {
        background: linear-gradient(135deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        border-radius: 15px;
    }

    .breadcrumb-item.active { color: var(--kf-orange); }

    /* Layout Adjustments */
    .documentation-container {
        max-width: 1400px; /* Sedikit lebih lebar agar muat sidebar + konten */
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid documentation-container py-5 px-xl-5">
    
    <div class="row g-5">
        
        <div class="col-lg-3 d-none d-lg-block">
            <div class="position-sticky" style="top: 100px;"> @include('panduan.sidebar')
            </div>
        </div>

        <div class="col-lg-9 col-12">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Panduan Pendaftaran</li>
                </ol>
            </nav>

            <header class="mb-5">
                <h1 class="fw-bold mb-3">Panduan Pendaftaran di <span class="text-orange">Key.Flavory.id</span></h1>
                <p class="lead text-muted" style="max-width: 800px;">
                    Selamat datang! Untuk mulai mengoptimalkan manajemen SDM dan absensi karyawan Anda dengan layanan HRMS Key.Flavory.id, 
                    silakan ikuti langkah-langkah pendaftaran berikut ini. Prosesnya cepat, aman, dan mudah.
                </p>
            </header>

            <main>
                <section class="mb-5">
                    <div class="card guide-card shadow-sm p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h2 class="h4 fw-bold mb-3"><i class="bi bi-box-arrow-in-right text-orange me-2"></i>Langkah Pertama</h2>
                                <p class="mb-0">Akses halaman utama kami dan cari tombol <strong class="text-orange">"Daftar"</strong> yang berada di pojok kanan atas halaman. Klik tombol tersebut untuk memulai perjalanan pengelolaan SDM bisnis Anda.</p>
                            </div>
                            <div class="col-md-4 text-center d-none d-md-block">
                                <i class="bi bi-cursor-fill text-orange" style="font-size: 4rem; opacity: 0.2;"></i>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mb-5">
                    <h2 class="h3 fw-bold mb-4">3 Tahapan Utama Pendaftaran</h2>
                    <div class="row g-4">
                        <div class="col-lg-4">
                            <article class="card h-100 guide-card shadow-sm p-4">
                                <div class="step-number">1</div>
                                <h3 class="h5 fw-bold">Membuat Akun Manager/Owner</h3>
                                <p class="text-muted small">Tahap awal adalah menentukan identitas akses Anda ke sistem HRMS.</p>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><i class="bi bi-check2-circle text-orange me-2"></i>Akun ini digunakan sebagai akses utama login.</li>
                                    <li class="mb-2"><i class="bi bi-check2-circle text-orange me-2"></i>Pastikan pendaftar adalah <strong>Pemilik</strong> atau <strong>Pengelola Bisnis</strong> (HR/Manager).</li>
                                </ul>
                            </article>
                        </div>

                        <div class="col-lg-4">
                            <article class="card h-100 guide-card shadow-sm p-4">
                                <div class="step-number">2</div>
                                <h3 class="h5 fw-bold">Mengisi Profil Manager/Owner</h3>
                                <p class="text-muted small">Lengkapi data diri untuk personalisasi sistem manajemen karyawan Anda.</p>
                                <div class="highlight-box p-3">
                                    <p class="small mb-0"><strong>Penting:</strong> Lengkapi seluruh data pada formulir secara akurat agar proses pengelolaan staf berjalan lancar.</p>
                                </div>
                            </article>
                        </div>

                        <div class="col-lg-4">
                            <article class="card h-100 guide-card shadow-sm p-4 border-orange">
                                <div class="step-number">3</div>
                                <h3 class="h5 fw-bold">Pembayaran Pendaftaran</h3>
                                <p class="text-muted small">Aktivasi akun Anda dengan investasi pendaftaran yang sangat terjangkau.</p>
                                <div class="text-center py-3">
                                    <span class="d-block text-muted small">Biaya Pendaftaran:</span>
                                    <span class="h3 fw-bold text-orange">Rp 88.000</span>
                                </div>
                                <p class="small text-center text-muted"><i class="bi bi-info-circle me-1"></i>Dibayarkan <strong>satu kali saja</strong> (bukan berlangganan bulanan).</p>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="mb-5">
                    <div class="verification-section p-4 p-md-5 shadow">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h2 class="fw-bold mb-3"><i class="bi bi-patch-check me-2"></i>Verifikasi Akun</h2>
                                <p>Setelah tahap pendaftaran selesai, sistem akan secara otomatis mengirimkan <strong>Kode OTP/Verifikasi</strong> ke alamat email yang Anda daftarkan.</p>
                                <ol class="mb-0">
                                    <li>Buka inbox email Anda (cek folder spam jika tidak ada).</li>
                                    <li>Salin kode unik yang Anda terima.</li>
                                    <li>Masukkan kode tersebut ke dalam form verifikasi di halaman Key.Flavory.id.</li>
                                </ol>
                            </div>
                            <div class="col-md-5 mt-4 mt-md-0 text-center">
                                <div class="bg-white text-dark p-4 rounded-3 shadow-sm">
                                    <i class="bi bi-envelope-open-heart text-orange fs-1 mb-2"></i>
                                    <p class="fw-bold mb-0">Cek Email Anda Sekarang!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="text-center py-4 bg-light rounded-4 border p-5">
                    <div class="mb-4">
                        <h2 class="h4 fw-bold">Siap Untuk Memulai?</h2>
                        <p class="text-muted">Jika verifikasi berhasil, Anda akan langsung diarahkan ke halaman Log In dan sudah bisa mulai menggunakan sistem.</p>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ url('/login') }}" class="btn btn-orange btn-lg px-5 py-3 shadow">
                            Log In ke Sistem <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <p class="mt-4 small text-muted mb-0">Butuh bantuan teknis? Hubungi tim support kami melalui menu bantuan.</p>
                </section>
            </main>

        </div> </div> </div> 

@endsection