@extends('layouts.app')

@section('title', 'FAQ - Pertanyaan yang Sering Diajukan | Key.Flavory.id')

@section('meta')
    <meta name="description" content="Punya pertanyaan seputar Key.Flavory.id? Temukan jawaban lengkap mengenai cara daftar, biaya pendaftaran, keamanan data, dan fitur HRMS kami di sini.">
    <meta name="keywords" content="FAQ key flavory, pertanyaan aplikasi kasir, cara menggunakan key flavory, pusat bantuan hrms, sistem manajemen karyawan">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
    }

    body {
        background-color: #fdfdfd;
    }

    /* Hero Section FAQ */
    .faq-hero {
        background: linear-gradient(135deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        padding: 80px 0;
        border-radius: 0 0 50px 50px;
        margin-bottom: 50px;
    }

    /* Accordion Custom Styling */
    .accordion-item {
        border: none;
        margin-bottom: 15px;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .accordion-button {
        font-weight: 600;
        color: #333;
        padding: 20px;
        background-color: #fff;
        transition: 0.3s;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--kf-orange-light);
        color: var(--kf-orange-dark);
        box-shadow: none;
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e8590c'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-body {
        padding: 20px;
        color: #555;
        line-height: 1.8;
        background-color: #fff;
    }

    .contact-card {
        background: white;
        border-radius: 20px;
        border-left: 5px solid var(--kf-orange);
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .text-orange { color: var(--kf-orange) !important; }
    .bg-orange { background-color: var(--kf-orange) !important; }

    @media (max-width: 768px) {
        .faq-hero { padding: 60px 0; }
        .display-5 { font-size: 2rem; }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<header class="faq-hero text-center shadow-sm">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3">FAQ - Pertanyaan yang Sering Diajukan</h1>
        <p class="lead opacity-90 mx-auto" style="max-width: 800px;">
            Temukan jawaban cepat atas pertanyaan umum seputar platform Key.Flavory.id. Kami siap membantu Anda mengelola bisnis dengan lebih mudah.
        </p>
    </div>
</header>

<main class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <article class="mb-5">
                <h2 class="h3 fw-bold mb-4 text-center"><i class="bi bi-patch-question text-orange me-2"></i>Informasi Umum</h2>
                
                <div class="accordion" id="accordionGeneral">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                Apa itu Key.Flavory.id?
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                <strong>Key.Flavory.id</strong> adalah platform Human Resource Management System (HRMS) dan manajemen bisnis yang dirancang untuk membantu UMKM serta industri F&B mengelola database karyawan, mengatur jadwal shift kerja, dan memantau absensi harian secara digital dan otomatis.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                Apakah Key.Flavory.id berbayar?
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Ya, kami menerapkan biaya pendaftaran sebesar <strong>Rp 88.000</strong>. Menariknya, ini adalah sistem <strong>Sekali Bayar (One-Time Payment)</strong>. Anda tidak perlu memikirkan biaya berlangganan bulanan yang memberatkan untuk terus menggunakan layanan kami.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                Bagaimana cara mendaftar?
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Langkahnya sangat mudah:
                                <ol class="mt-2">
                                    <li>Klik tombol <strong>Daftar</strong> di halaman utama.</li>
                                    <li>Lengkapi data akun Manager/Owner.</li>
                                    <li>Lakukan pembayaran pendaftaran.</li>
                                    <li>Lakukan verifikasi email (OTP), dan akun Anda siap digunakan untuk mendaftarkan karyawan.</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                Apakah bisa digunakan di HP (Handphone)?
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionGeneral">
                            <div class="accordion-body">
                                Tentu saja. Key.Flavory.id didesain dengan prinsip <strong>Mobile-First</strong>. Platform kami sangat ringan dan responsif, sehingga karyawan dapat melakukan absensi langsung dari browser HP mereka masing-masing tanpa perlu menginstal aplikasi berat.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <article class="mb-5">
                <h2 class="h3 fw-bold mb-4 text-center"><i class="bi bi-shield-lock text-orange me-2"></i>Keamanan & Teknis</h2>
                
                <div class="accordion" id="accordionTechnical">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                Bagaimana jika saya lupa password?
                            </button>
                        </h3>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                            <div class="accordion-body">
                                Jangan khawatir, Anda dapat menggunakan fitur <strong>"Lupa Password"</strong> pada halaman Login. Kami akan mengirimkan instruksi pengaturan ulang kata sandi ke alamat email Anda yang terdaftar untuk memastikan keamanan tetap terjaga.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                Apakah data saya aman?
                            </button>
                        </h3>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                            <div class="accordion-body">
                                Kami sangat serius menjaga keamanan data. Semua informasi akun dan transaksi dienkripsi dengan standar keamanan terkini. Kami juga menggunakan sistem <strong>Manager Key</strong> untuk memastikan hanya karyawan sah yang dapat mendaftar di bawah outlet Anda.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven">
                                Apakah bisa digunakan secara offline?
                            </button>
                        </h3>
                        <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionTechnical">
                            <div class="accordion-body">
                                Saat ini, Key.Flavory.id memerlukan koneksi internet untuk mengirimkan data absensi secara <strong>real-time</strong> ke server. Hal ini bertujuan agar Manager dapat memantau kehadiran staf secara langsung dari mana saja tanpa adanya jeda sinkronisasi.
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <section class="card contact-card p-4 p-md-5 text-center">
                <h2 class="h4 fw-bold mb-3">Belum menemukan jawaban?</h2>
                <p class="text-muted mb-4">Tim dukungan teknis kami siap membantu Anda menyelesaikan masalah atau menjawab pertanyaan seputar penggunaan platform.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="https://wa.me/6285797574754" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold">
                        <i class="bi bi-whatsapp me-2"></i> WhatsApp Kami
                    </a>
                </div>
            </section>

        </div>
    </div>
</main>
@endsection