@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan Penggunaan - Key.Flavory.id')

@section('meta')
    <meta name="description" content="Baca Syarat dan Ketentuan penggunaan Key.Flavory.id. Ketahui aturan penggunaan layanan, hak dan kewajiban pengguna, serta kebijakan pembayaran platform HRMS kami.">
    <meta name="keywords" content="syarat dan ketentuan, terms and conditions aplikasi kasir, ketentuan penggunaan Key Flavory, aturan hrms, legal key flavory">
@endsection

@section('content')
<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-dark: #e8590c;
        --kf-orange-light: #fff4e6;
        --kf-text-main: #343a40;
    }

    body {
        background-color: #fcfcfc;
        color: var(--kf-text-main);
    }

    .terms-header {
        background: linear-gradient(135deg, var(--kf-orange) 0%, var(--kf-orange-dark) 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: -60px;
    }

    .card-legal {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        background: white;
    }

    .legal-content section {
        margin-bottom: 45px;
        scroll-margin-top: 100px;
    }

    .legal-content h2 {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--kf-orange-dark);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .legal-content h2 i {
        margin-right: 12px;
        font-size: 1.2rem;
        color: var(--kf-orange);
    }

    .legal-content p, .legal-content li {
        line-height: 1.8;
        color: #555;
    }

    .legal-content ul li {
        margin-bottom: 10px;
    }

    /* Sidebar Navigation */
    .sidebar-sticky {
        position: sticky;
        top: 100px;
    }

    .nav-legal .nav-link {
        color: #6c757d;
        padding: 10px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: 0.3s;
        border-left: 3px solid transparent;
    }

    .nav-legal .nav-link:hover, .nav-legal .nav-link.active {
        background-color: var(--kf-orange-light);
        color: var(--kf-orange);
        border-left-color: var(--kf-orange);
    }

    .contact-card {
        background-color: #f8f9fa;
        border: 1px dashed var(--kf-orange);
        border-radius: 15px;
    }

    @media (max-width: 991px) {
        .terms-header { padding: 60px 0; }
        .display-5 { font-size: 2rem; }
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="terms-header">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Syarat dan Ketentuan Penggunaan</h1>
        <p class="lead opacity-90">Harap baca ketentuan ini dengan seksama sebelum menggunakan layanan kami.</p>
        <div class="mt-3 badge bg-white text-dark px-3 py-2 rounded-pill">
            Versi Terkini: {{ date('d F Y') }}
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-5">
        
        <aside class="col-lg-3 d-none d-lg-block">
            <div class="sidebar-sticky">
                <h5 class="fw-bold mb-3 px-3">Daftar Isi</h5>
                <nav class="nav flex-column nav-legal">
                    <a class="nav-link" href="#pendahuluan">1. Pendahuluan</a>
                    <a class="nav-link" href="#definisi">2. Definisi Istilah</a>
                    <a class="nav-link" href="#penggunaan">3. Penggunaan Layanan</a>
                    <a class="nav-link" href="#akun">4. Akun Pengguna</a>
                    <a class="nav-link" href="#pembayaran">5. Kebijakan Pembayaran</a>
                    <a class="nav-link" href="#tanggungjawab">6. Pembatasan Tanggung Jawab</a>
                    <a class="nav-link" href="#perubahan-layanan">7. Perubahan Layanan</a>
                    <a class="nav-link" href="#penangguhan">8. Penangguhan Akun</a>
                    <a class="nav-link" href="#perubahan-sk">9. Perubahan Ketentuan</a>
                    <a class="nav-link" href="#kontak">10. Kontak Bantuan</a>
                </nav>
            </div>
        </aside>

        <article class="col-lg-9">
            <div class="card card-legal p-4 p-md-5">
                <div class="legal-content">
                    
                    <section id="pendahuluan">
                        <h2><i class="bi bi-info-circle"></i> 1. Pendahuluan</h2>
                        <p>
                            Selamat datang di <strong>Key.Flavory.id</strong>. Dengan mengakses, mendaftar, atau menggunakan platform kami, Anda secara otomatis dianggap telah membaca, memahami, dan menyetujui untuk terikat oleh seluruh <strong>Syarat dan Ketentuan</strong> yang berlaku di sini.
                        </p>
                        <p>
                            Jika Anda tidak setuju dengan bagian mana pun dari ketentuan ini, Anda disarankan untuk tidak melanjutkan penggunaan layanan kami. Layanan ini disediakan oleh Thomas Lefvi Baehaqi sebagai bagian dari ekosistem Flavory.id.
                        </p>
                    </section>

                    <section id="definisi">
                        <h2><i class="bi bi-book"></i> 2. Definisi Istilah</h2>
                        <ul>
                            <li><strong>Platform:</strong> Seluruh sistem digital Key.Flavory.id yang mencakup situs web, dashboard hrms, dan fitur terkait.</li>
                            <li><strong>Pengguna:</strong> Pihak mana pun yang mengakses platform, baik itu pengunjung, Manager, maupun Karyawan.</li>
                            <li><strong>Manager/Owner:</strong> Pengguna yang memiliki otoritas tertinggi dalam satu entitas bisnis di platform untuk mengelola staf dan data.</li>
                            <li><strong>Karyawan:</strong> Pengguna yang didaftarkan oleh Manager untuk menggunakan fitur absensi dan jadwal kerja.</li>
                            <li><strong>Sistem:</strong> Perangkat lunak berbasis web yang menyediakan layanan manajemen SDM dan absensi.</li>
                        </ul>
                    </section>

                    <section id="penggunaan">
                        <h2><i class="bi bi-shield-check"></i> 3. Penggunaan Layanan</h2>
                        <p>
                            Pengguna wajib menggunakan platform ini sesuai dengan hukum yang berlaku di Republik Indonesia. Pengguna dilarang keras untuk:
                        </p>
                        <ul>
                            <li>Melakukan tindakan yang dapat merusak, melumpuhkan, atau membebani infrastruktur server kami.</li>
                            <li>Menggunakan fitur sistem untuk tindakan penipuan atau pemalsuan data absensi.</li>
                            <li>Mencoba mendapatkan akses tidak sah ke akun pengguna lain atau area terlarang dalam sistem.</li>
                        </ul>
                    </section>

                    <section id="akun">
                        <h2><i class="bi bi-person-lock"></i> 4. Akun Pengguna</h2>
                        <p>
                            Keamanan akun adalah tanggung jawab sepenuhnya dari masing-masing Pengguna. 
                        </p>
                        <ul>
                            <li>Pengguna wajib menjaga kerahasiaan <strong>Username</strong> dan <strong>Password</strong> miliknya.</li>
                            <li>Segala aktivitas yang terjadi di bawah akun Pengguna dianggap sebagai tindakan sah dari pemilik akun tersebut.</li>
                            <li>Manager bertanggung jawab penuh atas pembuatan dan distribusi <strong>Manager Key</strong> kepada karyawannya.</li>
                        </ul>
                    </section>

                    <section id="pembayaran">
                        <h2><i class="bi bi-credit-card"></i> 5. Kebijakan Pembayaran</h2>
                        <p>
                            Akses penuh ke layanan Manager Key.Flavory.id memerlukan pembayaran biaya pendaftaran sebesar <strong>Rp 88.000</strong> (atau sesuai harga promosi yang berlaku).
                        </p>
                        <ul>
                            <li>Pembayaran dilakukan sebanyak satu kali (sekali bayar) untuk akses seumur hidup sesuai ketentuan sistem.</li>
                            <li>Biaya yang telah dibayarkan bersifat <strong>non-refundable</strong> (tidak dapat dikembalikan) dengan alasan apa pun setelah akun diaktivasi.</li>
                        </ul>
                    </section>

                    <section id="tanggungjawab">
                        <h2><i class="bi bi-exclamation-octagon"></i> 6. Pembatasan Tanggung Jawab</h2>
                        <p>
                            Key.Flavory.id menyediakan platform "apa adanya" tanpa jaminan mutlak atas ketersediaan layanan 100% tanpa gangguan. Kami tidak bertanggung jawab atas:
                        </p>
                        <ul>
                            <li>Kesalahan input data yang dilakukan oleh Manager atau Karyawan.</li>
                            <li>Kerugian finansial atau operasional bisnis pengguna yang disebabkan oleh penyalahgunaan sistem.</li>
                            <li>Gangguan layanan yang disebabkan oleh pihak ketiga (provider hosting atau gangguan internet).</li>
                        </ul>
                    </section>

                    <section id="perubahan-layanan">
                        <h2><i class="bi bi-arrow-repeat"></i> 7. Perubahan Layanan</h2>
                        <p>
                            Kami berhak untuk memperbarui, mengubah, atau menghentikan sementara fitur-fitur tertentu dalam sistem guna meningkatkan kualitas layanan dan keamanan tanpa pemberitahuan tertulis sebelumnya kepada Pengguna.
                        </p>
                    </section>

                    <section id="penangguhan">
                        <h2><i class="bi bi-person-x"></i> 8. Penangguhan atau Penonaktifan Akun</h2>
                        <p>
                            Kami berhak melakukan penangguhan (suspend) atau penutupan akun secara permanen jika Pengguna terbukti melanggar Syarat dan Ketentuan ini, melakukan tindakan ilegal, atau merugikan stabilitas platform Key.Flavory.id.
                        </p>
                    </section>

                    <section id="perubahan-sk">
                        <h2><i class="bi bi-file-earmark-diff"></i> 9. Perubahan Syarat dan Ketentuan</h2>
                        <p>
                            Syarat dan Ketentuan ini dapat diubah atau diperbarui sewaktu-waktu. Perubahan tersebut akan berlaku segera setelah dipublikasikan di halaman ini. Pengguna disarankan untuk memeriksa halaman ini secara berkala untuk tetap mendapatkan informasi terbaru.
                        </p>
                    </section>

                    <section id="kontak" class="mb-0">
                        <h2><i class="bi bi-chat-dots"></i> 10. Kontak Bantuan</h2>
                        <p>
                            Jika Anda memiliki pertanyaan lebih lanjut mengenai Syarat dan Ketentuan ini atau mengalami kendala teknis pada platform, silakan hubungi tim kami:
                        </p>
                        <div class="contact-card p-4 mt-3">
                            <div class="row text-center text-md-start g-3">
                                <div class="col-md-6">
                                    <div class="fw-bold text-orange mb-1">Dukungan Email</div>
                                    <div class="text-dark">support@flavory.id</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="fw-bold text-orange mb-1">WhatsApp Fast Response</div>
                                    <div class="text-dark">+62 8xx-xxxx-xxxx</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
            
            <div class="mt-5 text-center">
                <p class="text-muted small">
                    Punya pertanyaan tentang data Anda? Baca <a href="{{ url('/kebijakan-privasi') }}" class="text-orange fw-bold text-decoration-none">Kebijakan Privasi</a> kami.
                </p>
            </div>
        </article>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Script untuk memicu active state pada sidebar saat scroll
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-legal .nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (pageYOffset >= sectionTop - 150) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        });
    });
</script>
@endpush