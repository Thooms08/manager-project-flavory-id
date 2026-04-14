@extends('layouts.app')

@section('title', 'Panduan Mengatur Jadwal Shift Karyawan - Key.Flavory.id')

@section('meta')
    <meta name="description" content="Pelajari cara mengatur jadwal shift karyawan di Key.Flavory.id. Panduan lengkap manajemen shift, pengaturan jam kerja, dan jadwal bulanan karyawan.">
    <meta name="keywords" content="jadwal shift karyawan, manajemen shift kasir, shift karyawan flavory, sistem hrms, atur jadwal kerja">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-gray: #6c757d;
    }

    body {
        background-color: #fdfdfd;
        color: #333;
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }
    
    .guide-header {
        background: linear-gradient(135deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        padding: 60px 0;
        border-radius: 30px; /* Disesuaikan agar melengkung rapi di dalam kolom */
        margin-bottom: 50px;
    }

    .card-step {
        border: none;
        border-radius: 15px;
        transition: transform 0.3s ease;
        background: #fff;
    }
    .card-step:hover {
        transform: translateY(-5px);
    }

    .step-icon {
        width: 50px;
        height: 50px;
        background-color: var(--kf-orange-light);
        color: var(--kf-orange);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .highlight-note {
        background-color: #fff3cd;
        border-left: 5px solid #ffc107;
        padding: 20px;
        border-radius: 8px;
    }

    .highlight-tips {
        background-color: var(--kf-orange-light);
        border-left: 5px solid var(--kf-orange);
        padding: 20px;
        border-radius: 8px;
    }

    .badge-shift {
        background-color: var(--kf-orange);
        color: white;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    /* Step Connector (Desktop Only) */
    @media (min-width: 992px) {
        .step-connector {
            position: relative;
        }
        .step-connector::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -15%;
            width: 30%;
            border-top: 2px dashed var(--kf-orange-light);
            z-index: 1;
        }
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
                    <li class="breadcrumb-item"><a href="/panduan" class="text-decoration-none text-muted">Panduan</a></li>
                    <li class="breadcrumb-item active text-orange fw-bold" aria-current="page">Manajemen Shift</li>
                </ol>
            </nav>

            <header class="guide-header shadow-sm px-4 px-md-5">
                <div class="text-center">
                    <h1 class="fw-bold display-5 mb-3">Panduan Mengatur Jadwal Shift Karyawan</h1>
                    <p class="lead opacity-90 mx-auto mb-0" style="max-width: 700px;">
                        Optimalkan operasional bisnis Anda dengan manajemen jadwal yang teratur di Key.Flavory.id. 
                        Ikuti langkah-langkah di bawah untuk mulai mengatur shift tim Anda.
                    </p>
                </div>
            </header>

            <main class="mb-5">
                <section class="mb-5 text-center">
                    <article>
                        <h2 class="h4 fw-bold mb-3">Langkah Lanjutan Setelah Input Data</h2>
                        <p class="text-muted">
                            Setelah Anda berhasil menginput data karyawan dan memberikan akses akun, 
                            langkah berikutnya yang sangat penting adalah mengatur <strong>Jadwal Shift Kerja</strong>. 
                            Hal ini memastikan setiap karyawan tahu kapan mereka harus bertugas dan sistem dapat mencatat absensi dengan akurat.
                        </p>
                    </article>
                </section>

                <section id="langkah-manajemen-shift" class="mb-5">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6 col-lg-4">
                            <div class="card card-step shadow-sm h-100 p-4">
                                <div class="step-icon"><i class="bi bi-calendar-event"></i></div>
                                <h3 class="h5 fw-bold">1. Akses Menu</h3>
                                <p class="small text-muted">
                                    Buka Dashboard Manager/Owner Anda, kemudian klik menu atau card bertuliskan 
                                    <strong class="text-orange">"Manajemen Shift"</strong>.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card card-step shadow-sm h-100 p-4">
                                <div class="step-icon"><i class="bi bi-plus-circle"></i></div>
                                <h3 class="h5 fw-bold">2. Buat Shift Baru</h3>
                                <p class="small text-muted">
                                    Klik tombol <span class="badge-shift">+ Shift Baru</span>. 
                                    Masukkan nama shift yang diinginkan.
                                </p>
                                <div class="mt-2 bg-light p-2 rounded small">
                                    Contoh: <strong>Shift Pagi, Shift Malam,</strong> atau <strong>Shift 1</strong>.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <div class="card card-step shadow-sm h-100 p-4">
                                <div class="step-icon"><i class="bi bi-people"></i></div>
                                <h3 class="h5 fw-bold">3. Tambah Karyawan</h3>
                                <p class="small text-muted">
                                    Klik card shift yang sudah dibuat, lalu pilih tombol <strong class="text-orange">+ Tambah Karyawan</strong> 
                                    untuk memasukkan staf ke dalam shift tersebut.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="mb-5 pt-4">
                    <h2 class="h3 fw-bold text-center mb-5">Pengaturan Jam & Kalender Kerja</h2>
                    
                    <div class="row align-items-center mb-5">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <article class="p-4 bg-white shadow-sm border-start border-4 border-orange rounded">
                                <h3 class="h5 fw-bold mb-3"><i class="bi bi-clock me-2 text-orange"></i>Mengatur Jam Kerja Karyawan</h3>
                                <p class="text-muted">Klik ikon <strong>kalender</strong> pada kolom aksi di daftar karyawan untuk mengatur detail waktu:</p>
                                <ul class="list-group list-group-flush small">
                                    <li class="list-group-item bg-transparent"><i class="bi bi-check2 text-orange me-2"></i><strong>Jam Masuk & Keluar:</strong> Waktu kerja inti karyawan.</li>
                                    <li class="list-group-item bg-transparent"><i class="bi bi-check2 text-orange me-2"></i><strong>Waktu Mulai Absen:</strong> Kapan karyawan bisa mulai melakukan absensi di aplikasi.</li>
                                    <li class="list-group-item bg-transparent"><i class="bi bi-check2 text-orange me-2"></i><strong>Batas Absen:</strong> Toleransi waktu maksimal untuk melakukan absen masuk.</li>
                                </ul>
                            </article>
                        </div>
                        <div class="col-lg-6">
                            <article class="p-4 bg-white shadow-sm border-start border-4 border-orange rounded">
                                <h3 class="h5 fw-bold mb-3"><i class="bi bi-calendar3 me-2 text-orange"></i>Mengatur Jadwal Bulanan</h3>
                                <p class="text-muted">Anda dapat mengatur jadwal sekaligus dalam satu bulan penuh:</p>
                                <div class="d-flex gap-2 mb-3">
                                    <span class="badge bg-success py-2 px-3">Pilih "Masuk"</span>
                                    <span class="text-muted align-self-center">→ Klik tanggal kerja di kalender</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-danger py-2 px-3">Pilih "Libur"</span>
                                    <span class="text-muted align-self-center">→ Klik tanggal libur di kalender</span>
                                </div>
                                <p class="mt-3 mb-0 small text-muted">Jangan lupa klik <strong>Simpan</strong> setelah selesai mengatur satu bulan.</p>
                            </article>
                        </div>
                    </div>
                </section>

                <section class="row g-4">
                    <div class="col-md-7">
                        <div class="highlight-note shadow-sm h-100">
                            <h3 class="h5 fw-bold mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i>Catatan Penting</h3>
                            <ul class="mb-0 small">
                                <li class="mb-2"><strong>Satu karyawan tidak dapat</strong> berada di dua shift berbeda pada tanggal yang sama untuk menghindari bentrok jadwal.</li>
                                <li>Anda dapat menempatkan karyawan berbeda di shift yang berbeda sesuai dengan kebutuhan operasional outlet/bisnis Anda.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="highlight-tips shadow-sm h-100">
                            <h3 class="h5 fw-bold mb-3"><i class="bi bi-lightbulb-fill me-2"></i>Tips Pengelolaan</h3>
                            <p class="small mb-0">
                                Gunakan penamaan shift yang sangat jelas seperti <strong>"Pagi - (08.00 - 16.00)"</strong>. 
                                Penamaan yang detail akan sangat memudahkan Anda saat melakukan monitoring laporan kehadiran di dashboard utama.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="text-center mt-5 pt-4">
                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h4 class="fw-bold mb-3">Sudah Mengerti Langkahnya?</h4>
                        <p class="text-muted mb-4">Ulangi langkah di atas untuk seluruh karyawan Anda agar sistem HRMS berjalan sempurna.</p>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{ url('/manager/manajemen-shift') }}" class="btn btn-orange btn-lg px-5 shadow rounded-pill">
                                Mulai Atur Shift Sekarang <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </section>
            </main>

        </div> </div> </div> 
@endsection