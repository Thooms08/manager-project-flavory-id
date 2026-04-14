@extends('layouts.app')

@section('title', 'Panduan Halaman Karyawan Key.Flavory.id - Fitur & Absensi')

@section('meta')
    <meta name="description" content="Panduan lengkap penggunaan halaman karyawan di Key.Flavory.id. Pelajari cara melihat jadwal shift, melakukan absensi, dan pengajuan izin/cuti dengan mudah.">
    <meta name="keywords" content="halaman karyawan kasir, fitur karyawan flavory, absensi dan jadwal kerja karyawan, hrms flavory, panduan kerja karyawan">
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
        color: #343a40;
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }
    
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: transform 0.3s ease;
    }
    .card-custom:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        background-color: var(--kf-orange-light);
        color: var(--kf-orange);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .step-number {
        font-weight: bold;
        color: var(--kf-orange);
        margin-right: 10px;
    }

    .note-box {
        background-color: #fff3cd;
        border-left: 5px solid #ffc107;
        border-radius: 8px;
        padding: 20px;
    }

    .btn-outline-orange {
        color: var(--kf-orange);
        border: 2px solid var(--kf-orange);
        font-weight: 600;
        border-radius: 8px;
        transition: 0.3s;
    }
    .btn-outline-orange:hover {
        background-color: var(--kf-orange);
        color: white;
    }

    /* Spacing for mobile */
    @media (max-width: 768px) {
        .display-5 { font-size: 1.8rem; }
        .section-padding { padding: 40px 0; }
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
                <h1 class="display-5 fw-bold mb-3">Panduan Halaman Karyawan di <span class="text-orange">Key.Flavory.id</span></h1>
                <p class="lead text-muted mx-auto" style="max-width: 800px;">
                    Selamat datang di pusat bantuan karyawan. Halaman ini dirancang untuk memudahkan Anda dalam mengelola aktivitas kerja harian, mulai dari memantau jadwal hingga melakukan absensi secara mandiri.
                </p>
            </header>

            <section class="mb-5">
                <div class="card card-custom p-4 border-start border-4 border-orange">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-orange fs-3 me-3"></i>
                        <div>
                            <h2 class="h5 fw-bold mb-1">Butuh Bantuan Masuk?</h2>
                            <p class="mb-0 text-muted">Jika Anda belum mengetahui cara masuk ke sistem, silakan baca <a href="{{ url('/panduan/login') }}" class="text-orange fw-bold text-decoration-none">Panduan Login Karyawan di sini</a>.</p>
                        </div>
                    </div>
                </div>
            </section>

            <main>
                <div class="row g-4 mb-5">
                    <article class="col-lg-4">
                        <section class="card h-100 card-custom p-4">
                            <div class="icon-circle">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <h2 class="h4 fw-bold">Melihat Jadwal Shift</h2>
                            <p class="text-muted small">Pastikan Anda selalu mengetahui waktu bertugas Anda agar operasional berjalan lancar.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">01.</span>
                                    <span>Klik tombol <strong class="text-orange">“Jadwal Shift”</strong> pada navigasi utama.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">02.</span>
                                    <span>Sistem akan menampilkan kalender atau daftar detail jadwal kerja yang telah ditentukan oleh Manager.</span>
                                </li>
                            </ul>
                        </section>
                    </article>

                    <article class="col-lg-4">
                        <section class="card h-100 card-custom p-4">
                            <div class="icon-circle">
                                <i class="bi bi-fingerprint"></i>
                            </div>
                            <h2 class="h4 fw-bold">Melakukan Absensi</h2>
                            <p class="text-muted small">Catat kehadiran Anda tepat waktu sesuai dengan jadwal yang berlaku.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">01.</span>
                                    <span>Gunakan fitur <strong class="text-orange">Absen Masuk</strong> saat memulai kerja dan <strong class="text-orange">Absen Keluar</strong> saat selesai.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">02.</span>
                                    <span>Pastikan koneksi internet stabil dan izinkan akses lokasi jika diminta oleh sistem.</span>
                                </li>
                            </ul>
                        </section>
                    </article>

                    <article class="col-lg-4">
                        <section class="card h-100 card-custom p-4">
                            <div class="icon-circle">
                                <i class="bi bi-file-earmark-medical"></i>
                            </div>
                            <h2 class="h4 fw-bold">Mengajukan Izin / Sakit</h2>
                            <p class="text-muted small">Berikan informasi jika Anda berhalangan hadir melalui prosedur resmi.</p>
                            <ul class="list-unstyled mt-3">
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">01.</span>
                                    <span>Pilih menu <strong class="text-orange">Pengajuan Izin/Cuti</strong> jika berhalangan masuk.</span>
                                </li>
                                <li class="mb-2 d-flex align-items-start">
                                    <span class="step-number">02.</span>
                                    <span>Wajib mengisi alasan dengan jelas dan melampirkan bukti (seperti surat dokter) jika diperlukan.</span>
                                </li>
                            </ul>
                        </section>
                    </article>
                </div>

                <section class="mb-5">
                    <div class="note-box shadow-sm">
                        <div class="row align-items-center">
                            <div class="col-md-1 text-center d-none d-md-block">
                                <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>
                            </div>
                            <div class="col-md-11">
                                <h3 class="h5 fw-bold mb-2 text-dark">Penting untuk Diperhatikan!</h3>
                                <p class="mb-0 text-dark opacity-75">
                                    Disiplin adalah kunci profesionalitas. Gunakan seluruh fitur di halaman karyawan dengan jujur agar data kehadiran dan kinerja Anda tercatat dengan baik serta akurat dalam sistem penggajian.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="text-center py-4">
                    <h4 class="fw-bold mb-4">Siap untuk mulai bekerja?</h4>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ url('/karyawan/dashboard') }}" class="btn bg-orange text-white px-5 py-3 shadow rounded-pill fw-bold">
                            Masuk ke Dashboard Karyawan
                        </a>
                        <a href="{{ url('/hubungi-kami') }}" class="btn btn-outline-orange px-5 py-3 rounded-pill">
                            Butuh Bantuan Lain?
                        </a>
                    </div>
                </section>
            </main>

        </div> </div> </div> 
@endsection