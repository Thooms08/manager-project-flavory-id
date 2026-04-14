@extends('layouts.app')

@section('title', 'Kebijakan Privasi - Key.Flavory.id | Keamanan Data Pengguna')

@section('meta')
    <meta name="description" content="Kebijakan Privasi Key.Flavory.id. Pelajari bagaimana kami mengumpulkan, melindungi, dan menggunakan data Anda dalam layanan HRMS dan aplikasi kasir kami.">
    <meta name="keywords" content="kebijakan privasi, privacy policy aplikasi kasir, keamanan data pengguna, key flavory id, perlindungan data hrms">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-text-dark: #212529;
        --kf-text-muted: #6c757d;
    }

    body {
        background-color: #f8f9fa;
    }

    .privacy-header {
        background: linear-gradient(135deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: -50px;
    }

    .card-privacy {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        background: white;
    }

    .privacy-content section {
        margin-bottom: 40px;
    }

    .privacy-content h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--kf-orange-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .privacy-content h2::before {
        content: "";
        display: inline-block;
        width: 4px;
        height: 24px;
        background-color: var(--kf-orange);
        margin-right: 12px;
        border-radius: 2px;
    }

    .privacy-content p, .privacy-content li {
        color: #4a4a4a;
        line-height: 1.8;
    }

    .last-updated {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
        margin-top: 10px;
    }

    .contact-box {
        background-color: var(--kf-orange-light);
        border: 1px solid rgba(253, 126, 20, 0.2);
        border-radius: 12px;
        padding: 25px;
    }

    /* Sticky Table of Contents for Desktop */
    .toc-sticky {
        position: sticky;
        top: 100px;
    }

    .toc-link {
        display: block;
        padding: 8px 16px;
        color: var(--kf-text-muted);
        text-decoration: none;
        border-left: 2px solid transparent;
        transition: 0.3s;
        font-size: 0.95rem;
    }

    .toc-link:hover, .toc-link.active {
        color: var(--kf-orange);
        border-left-color: var(--kf-orange);
        background-color: var(--kf-orange-light);
    }

    @media (max-width: 768px) {
        .privacy-header {
            padding: 60px 0;
        }
        .display-4 {
            font-size: 2.2rem;
        }
    }
</style>

<div class="privacy-header">
    <div class="container text-center">
        <h1 class="display-4 fw-bold">Kebijakan Privasi</h1>
        <p class="lead">Komitmen kami dalam menjaga data dan kepercayaan Anda</p>
        <p class="last-updated">Terakhir Diperbarui: {{ date('d F Y') }}</p>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="toc-sticky p-3">
                <h5 class="fw-bold mb-3">Navigasi</h5>
                <nav class="nav flex-column">
                    <a class="toc-link" href="#pendahuluan">Pendahuluan</a>
                    <a class="toc-link" href="#informasi">Informasi yang Dikumpulkan</a>
                    <a class="toc-link" href="#penggunaan">Penggunaan Informasi</a>
                    <a class="toc-link" href="#perlindungan">Perlindungan Data</a>
                    <a class="toc-link" href="#pembagian">Pembagian Informasi</a>
                    <a class="toc-link" href="#hak">Hak Pengguna</a>
                    <a class="toc-link" href="#perubahan">Perubahan Kebijakan</a>
                    <a class="toc-link" href="#kontak">Hubungi Kami</a>
                </nav>
            </div>
        </aside>

        <article class="col-lg-9">
            <div class="card card-privacy p-4 p-md-5">
                <div class="privacy-content">
                    
                    <section id="pendahuluan">
                        <h2>1. Pendahuluan</h2>
                        <p>
                            Selamat datang di <strong>Key.Flavory.id</strong>. Kami sangat menghargai privasi Anda dan berkomitmen penuh untuk melindungi data pribadi serta data bisnis Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan menjaga informasi saat Anda menggunakan layanan platform kami.
                        </p>
                        <p>
                            Dengan mengakses dan menggunakan platform kami, Anda dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan yang tertuang dalam Kebijakan Privasi ini.
                        </p>
                    </section>

                    <section id="informasi">
                        <h2>2. Informasi yang Kami Kumpulkan</h2>
                        <p>Kami mengumpulkan beberapa jenis informasi untuk memberikan dan meningkatkan layanan kami kepada Anda:</p>
                        <ul>
                            <li><strong>Data Akun:</strong> Informasi identitas seperti nama lengkap (Manager/Owner), alamat email, nomor telepon, dan username.</li>
                            <li><strong>Data Bisnis:</strong> Informasi operasional mencakup data menu, riwayat transaksi, data outlet, dan laporan penjualan.</li>
                            <li><strong>Data Karyawan:</strong> Informasi yang Anda masukkan mengenai staf Anda untuk keperluan HRMS, termasuk jadwal shift dan data kehadiran.</li>
                            <li><strong>Data Penggunaan:</strong> Informasi teknis seperti alamat IP, jenis perangkat, browser yang digunakan, dan aktivitas Anda di dalam sistem melalui <em>log files</em>.</li>
                        </ul>
                    </section>

                    <section id="penggunaan">
                        <h2>3. Penggunaan Informasi</h2>
                        <p>Informasi yang terkumpul digunakan untuk tujuan berikut:</p>
                        <ul>
                            <li>Menjalankan operasional sistem dan fitur-fitur Key.Flavory.id secara optimal.</li>
                            <li>Memproses verifikasi akun (OTP) dan menjaga keamanan akses sistem.</li>
                            <li>Memberikan dukungan teknis dan menanggapi pertanyaan atau keluhan Anda.</li>
                            <li>Melakukan analisis data untuk pengembangan fitur baru dan peningkatan performa sistem.</li>
                            <li>Mengirimkan informasi penting terkait pembaruan sistem atau promosi layanan (jika Anda menyetujuinya).</li>
                        </ul>
                    </section>

                    <section id="perlindungan">
                        <h2>4. Perlindungan Data</h2>
                        <p>
                            Kami menerapkan standar keamanan teknis dan organisasional yang memadai untuk melindungi data Anda dari akses tidak sah, perubahan, pengungkapan, atau penghancuran. Data sensitif seperti kata sandi disimpan menggunakan teknologi enkripsi tingkat tinggi.
                        </p>
                        <p>
                            Meskipun kami berusaha keras untuk melindungi informasi Anda, harap diingat bahwa tidak ada metode transmisi melalui internet atau metode penyimpanan elektronik yang 100% aman.
                        </p>
                    </section>

                    <section id="pembagian">
                        <h2>5. Pembagian Informasi Pihak Ketiga</h2>
                        <p>
                            Key.Flavory.id <strong>tidak akan menjual, menyewakan, atau menukarkan</strong> informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda. Kami hanya dapat membagikan informasi dalam kondisi berikut:
                        </p>
                        <ul>
                            <li>Diperlukan oleh hukum atau proses hukum yang berlaku.</li>
                            <li>Untuk melindungi hak, properti, atau keamanan Key.Flavory.id serta pengguna lainnya.</li>
                            <li>Kepada penyedia layanan infrastruktur (seperti hosting) yang bekerja di bawah kontrak kerahasiaan yang ketat dengan kami.</li>
                        </ul>
                    </section>

                    <section id="hak">
                        <h2>6. Hak Pengguna</h2>
                        <p>Sebagai pengguna, Anda memiliki hak-hak berikut terkait data Anda:</p>
                        <ul>
                            <li><strong>Hak Akses:</strong> Melihat data pribadi dan bisnis yang tersimpan di sistem kami.</li>
                            <li><strong>Hak Koreksi:</strong> Mengubah atau memperbarui informasi akun yang sudah tidak akurat melalui dashboard profil.</li>
                            <li><strong>Hak Penghapusan:</strong> Meminta penutupan akun dan penghapusan data secara permanen, sesuai dengan ketentuan hukum yang berlaku.</li>
                        </ul>
                    </section>

                    <section id="perubahan">
                        <h2>7. Perubahan Kebijakan</h2>
                        <p>
                            Kami berhak memperbarui Kebijakan Privasi ini sewaktu-waktu untuk mengikuti perkembangan layanan atau perubahan regulasi hukum. Kami akan memberitahukan perubahan signifikan melalui email atau notifikasi pada platform kami. Anda disarankan untuk meninjau halaman ini secara berkala.
                        </p>
                    </section>

                    <section id="kontak" class="mb-0">
                        <h2>8. Kontak Kami</h2>
                        <p>Jika Anda memiliki pertanyaan, kekhawatiran, atau keluhan mengenai Kebijakan Privasi ini, silakan hubungi tim dukungan kami melalui:</p>
                        <div class="contact-box mt-3">
                            <div class="row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h6 class="fw-bold mb-1"><i class="bi bi-envelope-fill text-orange me-2"></i> Email</h6>
                                    <span>support@flavory.id</span>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold mb-1"><i class="bi bi-whatsapp text-orange me-2"></i> WhatsApp Support</h6>
                                    <span>+62 8xx-xxxx-xxxx</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="text-muted small">
                    Dengan menggunakan Key.Flavory.id, Anda tunduk pada 
                    <a href="{{ url('/syarat-ketentuan') }}" class="text-orange text-decoration-none">Syarat & Ketentuan Layanan</a> kami.
                </p>
            </div>
        </article>
    </div>
</div>
@endsection