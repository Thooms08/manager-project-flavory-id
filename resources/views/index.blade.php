@extends('layouts.app')

@section('title', 'Key.Flavory.id - Aplikasi HRMS & Kelola Absensi Shift Karyawan')

@section('meta')
    <meta name="description" content="Key.Flavory.id adalah platform HRMS terbaik untuk mengelola data karyawan, menyusun jadwal shift kerja, dan merekap absensi secara online. Biaya daftar hanya Rp88.000 sekali bayar.">
    <meta name="keywords" content="aplikasi absensi online, software hrms, manajemen karyawan, aplikasi pembuat jadwal shift, sistem absensi kasir, aplikasi hrd ukm, key flavory id">
@endsection

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        padding: 5rem 0 6rem 0;
        background: radial-gradient(circle at top right, var(--brand-light) 0%, #ffffff 100%);
        overflow: hidden;
    }
    
    .text-orange { color: var(--brand-primary) !important; }
    .bg-orange-soft { background-color: var(--brand-light); }
    
    /* Modern Cards */
    .feature-card {
        background: #ffffff;
        border-radius: 1.5rem;
        border: 1px solid #f1f5f9;
        padding: 2.5rem;
        height: 100%;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
    }
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: #ffedd5;
    }
    
    .icon-box {
        width: 60px; height: 60px;
        border-radius: 1rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        background: var(--brand-light);
        color: var(--brand-primary);
    }

    /* Pricing Section */
    .pricing-card {
        background: linear-gradient(135deg, var(--text-main) 0%, #1e293b 100%);
        border-radius: 2rem;
        color: white;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .pricing-card::before {
        content: ''; position: absolute; right: -10%; top: -20%;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(249,115,22,0.3) 0%, rgba(249,115,22,0) 70%);
        border-radius: 50%; pointer-events: none;
    }
    .price-tag { font-size: 3.5rem; font-weight: 800; color: var(--brand-primary); line-height: 1; }
    .strike-price { text-decoration: line-through; opacity: 0.6; font-size: 1.5rem; }
    
    /* Utility */
    .section-title { font-weight: 800; letter-spacing: -0.5px; }
    
    .link-panduan {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--brand-primary);
        text-decoration: none;
        margin-top: auto;
        display: inline-block;
        padding-top: 15px;
        transition: 0.2s;
    }
    .link-panduan:hover { color: var(--brand-hover); text-decoration: underline; }
</style>
@endpush

@section('content')

    <header id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="badge bg-orange-soft text-orange px-3 py-2 rounded-pill mb-3 fw-semibold border border-warning-subtle">
                        🚀 Platform HRMS #1 untuk UMKM & F&B
                    </span>
                    <h1 class="display-4 fw-bold text-main mb-4" style="line-height: 1.2;">
                        Kelola Karyawan & Jadwal Shift Tanpa <span class="text-orange">Sakit Kepala.</span>
                    </h1>
                    <p class="text-muted fs-5 mb-5" style="max-width: 90%;">
                        Tinggalkan cara manual yang merepotkan. Pantau absensi, kelola shift kerja bulanan, dan unduh laporan kehadiran secara otomatis dalam satu sistem cerdas.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#harga" class="btn btn-brand btn-lg px-4 d-flex align-items-center gap-2 shadow-sm">
                            Daftar Sekarang <i class="bi bi-arrow-right"></i>
                        </a>
                        <a href="#fitur" class="btn btn-light btn-lg px-4 border d-flex align-items-center fw-medium hover-orange">
                            Jelajahi Fitur
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800" alt="Ilustrasi Dashboard Key Flavory Aplikasi HRMS" class="img-fluid rounded-4 shadow-lg" style="border: 8px solid white;">
                        
                        <div class="position-absolute bottom-0 start-0 translate-middle-x bg-white p-3 rounded-4 shadow-lg d-none d-md-flex align-items-center gap-3" style="margin-bottom: 2rem;">
                            <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle">
                                <i class="bi bi-check-circle-fill fs-3"></i>
                            </div>
                            <div class="text-start">
                                <strong class="d-block mb-0 fw-bold">Absensi Berhasil</strong>
                                <small class="text-muted">Hari ini, 08:00 WIB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-5 bg-white border-top">
        <div class="container py-4">
            <header class="text-center mb-5 mx-auto" style="max-width: 700px;">
                <h2 class="section-title h1 mb-3">Kontrol Penuh di Tangan <span class="text-orange">Manager</span></h2>
                <p class="text-muted fs-6">Desain sistem HRD operasional Anda sendiri. Pantau data karyawan aktif/nonaktif, hingga rekap laporan absensi bulanan dari mana saja.</p>
            </header>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <article class="feature-card">
                        <div class="icon-box"><i class="bi bi-people-fill"></i></div>
                        <h3 class="h4 fw-bold mb-3">Manajemen Karyawan</h3>
                        <p class="text-muted mb-3">Input data staf Anda secara terpusat. Kelola status Karyawan Aktif/Nonaktif, serta hasilkan <strong>Manager Key</strong> untuk otentikasi pendaftaran akun karyawan secara mandiri dan aman.</p>
                        <a href="{{ route('panduan.data-karyawan') }}" class="link-panduan">Lihat Panduan Kelola Data <i class="bi bi-arrow-right ms-1"></i></a>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="feature-card">
                        <div class="icon-box"><i class="bi bi-calendar-range"></i></div>
                        <h3 class="h4 fw-bold mb-3">Jadwal Shift Fleksibel</h3>
                        <p class="text-muted mb-3">Buat tipe shift tanpa batas (Pagi, Siang, Malam). Tentukan kalender jadwal kerja bulanan dengan mudah, lengkap dengan batas toleransi waktu absen masuk & keluar.</p>
                        <a href="{{ route('panduan.shift-karyawan') }}" class="link-panduan">Lihat Panduan Atur Shift <i class="bi bi-arrow-right ms-1"></i></a>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article class="feature-card">
                        <div class="icon-box"><i class="bi bi-file-earmark-excel-fill"></i></div>
                        <h3 class="h4 fw-bold mb-3">Laporan Rekap Absensi</h3>
                        <p class="text-muted mb-3">Pantau kedisiplinan secara *real-time*. Deteksi keterlambatan, sakit, atau izin. Butuh untuk penggajian? Langsung unduh laporan akhir dalam format <strong>Excel (.xlsx)</strong> siap olah.</p>
                        <a href="{{ route('panduan.absensi-karyawan') }}" class="link-panduan">Lihat Panduan Rekap Data <i class="bi bi-arrow-right ms-1"></i></a>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-app border-top border-bottom">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 order-lg-2">
                    <h2 class="section-title h1 mb-3">Sangat Mudah Digunakan Oleh <span class="text-orange">Karyawan</span></h2>
                    <p class="text-muted mb-4 fs-5">Tidak ada lagi antrean panjang di mesin *fingerprint*. Semua proses harian dilakukan langsung dari *smartphone* karyawan.</p>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="icon-box flex-shrink-0 bg-white shadow-sm" style="width: 50px; height: 50px; font-size: 1.25rem;"><i class="bi bi-fingerprint"></i></div>
                        <div>
                            <h3 class="h5 fw-bold mb-1">Absensi & Izin Digital</h3>
                            <p class="text-muted small">Lakukan <strong>Absen Masuk</strong> dan <strong>Absen Keluar</strong> sesuai jam operasional shift. Berhalangan hadir? Cukup isi form pengajuan Izin/Sakit/Cuti langsung di aplikasi.</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="icon-box flex-shrink-0 bg-white shadow-sm" style="width: 50px; height: 50px; font-size: 1.25rem;"><i class="bi bi-calendar-event"></i></div>
                        <div>
                            <h3 class="h5 fw-bold mb-1">Kalender Jadwal Pribadi</h3>
                            <p class="text-muted small">Setiap staf memiliki akses mandiri untuk mengecek jadwal shift harian mereka dan hari libur yang telah ditetapkan oleh Manager.</p>
                        </div>
                    </div>

                    <a href="{{ route('panduan.karyawan') }}" class="btn btn-outline-brand rounded-pill px-4 py-2 mt-2">
                        Jelajahi Halaman Karyawan
                    </a>
                </div>
                
                <div class="col-lg-7 order-lg-1">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <article class="p-4 bg-white rounded-4 border text-center h-100 shadow-sm transition">
                                <i class="bi bi-phone text-muted" style="font-size: 4rem;"></i>
                                <h4 class="h5 fw-bold mt-3">Mobile Friendly</h4>
                                <p class="small text-muted mb-0">Antarmuka responsif (UI/UX) layaknya aplikasi *native*, sangat ringan diakses lewat browser HP.</p>
                            </article>
                        </div>
                        <div class="col-sm-6">
                            <article class="p-4 bg-orange-soft rounded-4 border border-warning-subtle text-center h-100 mt-sm-4 shadow-sm">
                                <i class="bi bi-shield-check text-orange" style="font-size: 4rem;"></i>
                                <h4 class="h5 fw-bold mt-3 text-orange">Verifikasi Aman</h4>
                                <p class="small text-muted mb-0">Aktivasi akun karyawan terlindungi dengan <strong>Manager Key</strong> untuk mencegah penyalahgunaan data.</p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="harga" class="py-5 mt-5 mb-4">
        <div class="container">
            <div class="pricing-card text-center text-md-start">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-4 mb-lg-0 z-1">
                        <span class="badge bg-white text-dark px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm">Penawaran Spesial Promo</span>
                        <h2 class="display-5 fw-bold mb-3">Investasi Cerdas untuk Bisnis Anda.</h2>
                        <p class="fs-5 text-white-50 mb-4" style="max-width: 500px;">
                            Lupakan biaya berlangganan bulanan (*subscription*) yang memberatkan. Bayar cukup sekali di awal pendaftaran, dan gunakan sistem kami selamanya untuk seluruh outlet Anda.
                        </p>
                        <ul class="list-unstyled d-flex flex-wrap gap-4 text-white-50">
                            <li><i class="bi bi-check-circle-fill text-orange me-2"></i> Akses Selamanya</li>
                            <li><i class="bi bi-check-circle-fill text-orange me-2"></i> Tanpa Biaya Tersembunyi</li>
                            <li><i class="bi bi-check-circle-fill text-orange me-2"></i> Jumlah Karyawan Tak Terbatas</li>
                        </ul>
                    </div>
                    <div class="col-lg-5 text-center z-1">
                        <article class="bg-white rounded-4 p-4 p-md-5 text-dark shadow-lg">
                            <p class="text-muted fw-bold mb-1 text-uppercase tracking-wider" style="letter-spacing: 1px;">Harga Normal</p>
                            <div class="strike-price text-danger mb-2">Rp 500.000</div>
                            <div class="d-flex justify-content-center align-items-start gap-1 mb-4">
                                <span class="fs-4 fw-bold text-orange mt-2">Rp</span>
                                <span class="price-tag">88<span class="fs-1">.000</span></span>
                            </div>
                            <a href="{{ route('register') }}" class="btn btn-brand w-100 py-3 fs-5 mb-3 shadow-sm">
                                Daftar Sekarang Juga
                            </a>
                            <small class="text-muted d-block mb-2"><i class="bi bi-lock-fill"></i> Pembayaran 1x, Akses Selamanya.</small>
                            <a href="{{ route('panduan.daftar') }}" class="small fw-semibold text-orange text-decoration-none">Lihat Panduan Registrasi &rarr;</a>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // Script ringan untuk membuat navbar mengecil/solid saat di-scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (window.scrollY > 50) {
            navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';
            navbar.style.paddingTop = '10px';
            navbar.style.paddingBottom = '10px';
        } else {
            navbar.style.boxShadow = '0 1px 3px rgba(0,0,0,0.05)';
            navbar.style.paddingTop = '16px';
            navbar.style.paddingBottom = '16px';
        }
    });
</script>
@endpush