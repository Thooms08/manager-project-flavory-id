@extends('layouts.app')

@section('title', 'Tentang Key.Flavory.id - Solusi Manajemen Bisnis & HRMS Modern')

@section('meta')
    <meta name="description" content="Pelajari lebih lanjut tentang Key.Flavory.id, platform all-in-one untuk sistem kasir digital, manajemen karyawan, absensi shift, dan laporan bisnis otomatis untuk UMKM.">
    <meta name="keywords" content="tentang key flavory, aplikasi kasir digital, sistem manajemen bisnis, hrms indonesia, manajemen karyawan cafe">
@endsection

@section('content')
<style>
    :root {
        --brand-orange: #f97316;
        --brand-orange-dark: #ea580c;
        --brand-orange-light: #fff7ed;
        --text-dark: #1e293b;
    }

    body {
        background-color: #ffffff;
        color: var(--text-dark);
    }

    /* Hero Section */
    .about-hero {
        background: linear-gradient(135deg, var(--brand-orange) 0%, var(--brand-orange-dark) 100%);
        color: white;
        padding: 100px 0;
        border-radius: 0 0 50px 50px;
    }

    /* Section Styling */
    .section-padding {
        padding: 80px 0;
    }

    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
        font-weight: 700;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background-color: var(--brand-orange);
        border-radius: 2px;
    }

    .section-title-center::after {
        left: 50%;
        transform: translateX(-50%);
    }

    /* Card Keunggulan */
    .card-feature {
        border: none;
        border-radius: 20px;
        padding: 30px;
        height: 100%;
        transition: all 0.3s ease;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .card-feature:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(249, 115, 22, 0.15);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background-color: var(--brand-orange-light);
        color: var(--brand-orange);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    /* Visi Misi */
    .vision-mision-box {
        background-color: var(--brand-orange-light);
        border-radius: 30px;
        padding: 50px;
    }

    .list-mision li {
        margin-bottom: 15px;
        display: flex;
        align-items: start;
        gap: 10px;
    }

    .list-mision i {
        color: var(--brand-orange);
        font-size: 1.2rem;
    }

    /* Call to Action */
    .cta-section {
        background-color: var(--text-dark);
        color: white;
        border-radius: 30px;
        padding: 60px;
    }

    .btn-cta {
        background-color: var(--brand-orange);
        color: white;
        border: none;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-cta:hover {
        background-color: var(--brand-orange-dark);
        color: white;
        transform: scale(1.05);
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<header class="about-hero">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-3">Tentang Key.Flavory.id</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 700px;">
            Partner digital terpercaya untuk transformasi operasional bisnis Anda menjadi lebih modern, efisien, dan terorganisir.
        </p>
    </div>
</header>

<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="section-title">Solusi All-in-One Manajemen Bisnis</h2>
                <p class="text-muted leading-relaxed">
                    <strong>Key.Flavory.id</strong> lahir dari kebutuhan para pelaku usaha yang menginginkan sistem manajemen yang komprehensif namun tetap sederhana untuk digunakan. Kami memahami bahwa mengelola bisnis bukan hanya soal transaksi, tapi juga soal manusia dan data.
                </p>
                <p class="text-muted mb-4">
                    Platform kami mengintegrasikan berbagai fungsi krusial mulai dari sistem kasir digital hingga manajemen sumber daya manusia (HRMS) dalam satu dasbor terpadu.
                </p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-orange"></i>
                            <span>Sistem Kasir</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-orange"></i>
                            <span>Absensi & Shift</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-orange"></i>
                            <span>Manajemen Staf</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill text-orange"></i>
                            <span>Laporan Otomatis</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light rounded-5 p-5 text-center">
                    <i class="bi bi-laptop text-orange" style="font-size: 10rem;"></i>
                    <p class="mt-3 fw-medium">Dirancang untuk Efisiensi Digital</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="vision-mision-box bg-white shadow-sm">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h2 class="section-title">Visi Kami</h2>
                    <p class="fs-5 fw-medium italic text-orange">
                        "Menjadi solusi digital terbaik untuk pengelolaan bisnis modern di Indonesia."
                    </p>
                </div>
                <div class="col-lg-7">
                    <h2 class="section-title">Misi Kami</h2>
                    <ul class="list-unstyled list-mision">
                        <li>
                            <i class="bi bi-stars"></i>
                            <span><strong>Sistem User-Friendly:</strong> Menyediakan teknologi yang intuitif sehingga mudah digunakan oleh siapa saja, bahkan tanpa latar belakang IT.</span>
                        </li>
                        <li>
                            <i class="bi bi-lightning-charge"></i>
                            <span><strong>Efisiensi Operasional:</strong> Memangkas waktu administratif bisnis agar Owner bisa lebih fokus pada pengembangan usaha.</span>
                        </li>
                        <li>
                            <i class="bi bi-graph-up-arrow"></i>
                            <span><strong>Data Driven Insight:</strong> Memberikan laporan bisnis yang akurat untuk membantu pengambilan keputusan yang lebih tepat sasaran.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container text-center">
        <h2 class="section-title section-title-center mb-5">Kenapa Memilih Key.Flavory.id?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-layers"></i></div>
                    <h3 class="h5 fw-bold">All-in-One System</h3>
                    <p class="text-muted small">Kelola kasir, karyawan, dan laporan keuangan dalam satu platform tanpa perlu banyak aplikasi tambahan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-hand-index-thumb"></i></div>
                    <h3 class="h5 fw-bold">User Friendly</h3>
                    <p class="text-muted small">Tampilan bersih dan navigasi sederhana yang dirancang khusus untuk kenyamanan pengguna mobile maupun desktop.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-phone"></i></div>
                    <h3 class="h5 fw-bold">Multi Perangkat</h3>
                    <p class="text-muted small">Akses data bisnis Anda kapan saja dan di mana saja. Kompatibel dengan smartphone, tablet, maupun laptop.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-tags"></i></div>
                    <h3 class="h5 fw-bold">Harga Terjangkau</h3>
                    <p class="text-muted small">Sistem sekali bayar yang sangat hemat untuk UMKM. Tanpa biaya langganan bulanan yang membebani kas bisnis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-rocket-takeoff"></i></div>
                    <h3 class="h5 fw-bold">Terus Berkembang</h3>
                    <p class="text-muted small">Kami rutin melakukan pembaruan fitur berdasarkan masukan pengguna untuk memastikan bisnis Anda tetap relevan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-feature text-start">
                    <div class="icon-box"><i class="bi bi-headset"></i></div>
                    <h3 class="h5 fw-bold">Dukungan Responsif</h3>
                    <p class="text-muted small">Tim bantuan kami siap mendampingi Anda jika menemukan kendala teknis saat operasional berlangsung.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="section-title section-title-center">Siapa yang Menggunakan Kami?</h2>
                <p class="text-muted mb-5">Key.Flavory.id dirancang fleksibel untuk berbagai lini bisnis operasional harian.</p>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                            <i class="bi bi-cup-hot text-orange fs-2 mb-3 d-block"></i>
                            <h4 class="h6 fw-bold">Owner F&B</h4>
                            <p class="small text-muted mb-0">Cafe, Restoran, Kedai Kopi, dan Booth Makanan.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                            <i class="bi bi-shop text-orange fs-2 mb-3 d-block"></i>
                            <h4 class="h6 fw-bold">Pelaku UMKM</h4>
                            <p class="small text-muted mb-0">Toko Retail, Butik, dan jasa layanan harian.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                            <i class="bi bi-people text-orange fs-2 mb-3 d-block"></i>
                            <h4 class="h6 fw-bold">Bisnis Bertim</h4>
                            <p class="small text-muted mb-0">Bisnis dengan banyak karyawan dan sistem shift.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="cta-section text-center">
            <h2 class="display-6 fw-bold mb-3">Siap Modernisasi Bisnis Anda?</h2>
            <p class="mb-4 opacity-75">Bergabunglah dengan ratusan owner lainnya yang telah beralih ke efisiensi digital.</p>
            <a href="{{ route('register') }}" class="btn btn-cta shadow-lg">Mulai Gunakan Sekarang</a>
        </div>
    </div>
</section>
@endsection