<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan | Key.Flavory.id</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        /* === COLOR VARIABLES === */
        :root {
            --brand-primary: #f97316; /* Orange 500 */
            --brand-hover: #ea580c;   /* Orange 600 */
            --brand-light: #ffedd5;   /* Orange 100 */
            --text-main: #0f172a;
            --text-muted: #64748b;
            --bg-app: #f8fafc;
            --card-bg: #ffffff;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --shadow-soft: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* === GLOBAL STYLES === */
        body {
            background-color: var(--bg-app);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            padding-top: 85px;
            padding-bottom: 40px;
            -webkit-font-smoothing: antialiased;
        }

        /* === NAVBAR === */
        .navbar-custom {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }
        
        .brand-icon-box {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--brand-primary), #fb923c);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; box-shadow: 0 4px 6px -1px rgba(249, 115, 22, 0.3);
        }

        /* === CARDS === */
        .card-custom {
            background: var(--card-bg);
            border: none;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-soft);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--brand-primary) 0%, #fb923c 100%);
            color: white;
            position: relative;
        }
        
        .welcome-card::after {
            content: ''; position: absolute; right: -5%; top: -20%;
            width: 250px; height: 250px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%; pointer-events: none;
        }

        .time-box {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-lg);
        }

        .shift-info-box {
            background: #f1f5f9;
            border-radius: var(--radius-lg);
            border: 1px dashed #cbd5e1;
        }

        /* === BUTTONS & INTERACTIONS === */
        .btn-modern {
            border-radius: 14px;
            font-weight: 600;
            padding: 14px 24px;
            transition: all 0.2s ease;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        }
        
        .btn-modern:active { transform: scale(0.97); } /* Click feedback */

        .btn-primary-custom {
            background: var(--brand-primary);
            color: white; border: none;
            box-shadow: 0 4px 14px 0 rgba(249, 115, 22, 0.39);
        }
        
        .btn-primary-custom:hover:not(:disabled) {
            background: var(--brand-hover); color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.4);
        }

        .btn-primary-custom:disabled {
            background: #e2e8f0; color: #94a3b8;
            box-shadow: none; cursor: not-allowed;
        }

        .btn-outline-custom {
            background: white;
            color: var(--text-main);
            border: 1px solid #e2e8f0;
        }

        .btn-outline-custom:hover:not(:disabled) {
            background: var(--bg-app);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        /* Animation for active absent button */
        @keyframes pulse-orange {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
        .btn-pulse { animation: pulse-orange 2s infinite; }

        /* === BADGES === */
        .badge-status {
            padding: 8px 16px; border-radius: 50rem;
            font-weight: 600; font-size: 0.85rem;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .badge-active { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .badge-inactive { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .badge-info { background: #e0f2fe; color: #075985; border: 1px solid #bae6fd; }

        /* === CALENDAR GRID === */
        .calendar-grid {
            display: grid; grid-template-columns: repeat(7, 1fr); gap: 10px;
        }
        .calendar-day {
            aspect-ratio: 1; border-radius: 12px;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            font-weight: 600; font-size: 1rem; cursor: pointer;
            transition: all 0.2s ease; border: 2px solid transparent;
        }
        .calendar-day:hover { transform: translateY(-3px); box-shadow: var(--shadow-soft); z-index: 2; border-color: var(--brand-light); }
        .day-work { background-color: var(--brand-light); color: var(--brand-primary); }
        .day-off { background-color: #fee2e2; color: #dc2626; }
        .day-empty { background-color: #f8fafc; color: #94a3b8; border: 1px dashed #e2e8f0; }
        
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }

        /* === TOAST NOTIFICATION === */
        .toast-container { position: fixed; top: 20px; right: 20px; z-index: 1060; }
        .custom-toast {
            min-width: 300px; border-radius: 12px; border: none;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            animation: slideInRight 0.4s ease-out forwards;
        }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        .btn-tutor {
            background-color: transparent;
            color: var(--text-dark);
            border: 1px solid rgba(43, 52, 64, 0.15);
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-tutor:hover {
            background-color: #f8f9fa;
            color: var(--orange-primary);
            border-color: rgba(253, 126, 20, 0.3);
        }
    </style>
</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-2 border-bottom shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">
        
        <a href="#" class="navbar-brand d-flex align-items-center text-decoration-none gap-2">
            <div class="brand-icon-box bg-main-light d-flex align-items-center justify-content-center rounded-3" style="width: 40px; height: 40px;">
                <i class="bi bi-person fs-5 text-main"></i>
            </div>
            <div class="d-flex flex-column">
                <span class="fw-bold fs-5 text-dark lh-1">Key.Flavory.id</span>
                <small class="text-muted" style="font-size: 0.75rem;">Panel Karyawan</small>
            </div>
        </a>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('panduan.karyawan') }}" class="btn btn-light border d-flex align-items-center justify-content-center rounded-circle" style="width: 38px; height: 38px;" title="Panduan">
                <i class="bi bi-question-circle text-secondary"></i>
            </a>
            
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-medium d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="d-none d-sm-inline">Keluar</span>
                </button>
            </form>
        </div>

    </div>
</nav>

    <div class="toast-container">
        @if(session('success'))
            <div class="toast custom-toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill fs-5"></i> {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="toast custom-toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-medium d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-octagon-fill fs-5"></i> {{ session('error') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="toast custom-toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body fw-medium">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Periksa kembali inputan Anda.
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">
                
                <div class="card card-custom welcome-card mb-4 p-4 p-md-5">
                    <div class="row align-items-center" style="z-index: 1;">
                        <div class="col-sm-7 mb-4 mb-sm-0 text-center text-sm-start">
                            <p class="mb-1 text-white-50 fw-semibold text-uppercase tracking-wider" style="letter-spacing: 1px; font-size: 0.8rem;">Selamat Bekerja</p>
                            <h2 class="fw-bold mb-0 fs-1">Hai, {{ explode(' ', $karyawan->nama ?? 'Karyawan')[0] }}!</h2>
                            <p class="mb-0 mt-2 text-white-50" style="font-size: 0.95rem;">Semoga harimu menyenangkan dan produktif.</p>
                        </div>
                        <div class="col-sm-5 text-center text-sm-end">
                            <div class="time-box p-3 d-inline-block text-center">
                                <span class="d-block text-white-50 small mb-1">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}</span>
                                <h3 class="fw-bold mb-0 text-white font-monospace" id="live-time">
                                    {{ \Carbon\Carbon::now()->format('H:i') }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-custom p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h5 class="fw-bold text-main mb-3">Status Kehadiran Hari Ini</h5>
                        
                        @php
                            $adaJadwal = isset($jadwalHariIni) && $jadwalHariIni->tgl_masuk != null;
                        @endphp

                        @if($adaJadwal)
                            <div class="badge-status badge-active mb-4">
                                <i class="bi bi-briefcase-fill"></i> Anda memiliki jadwal shift hari ini
                            </div>

                            <div class="shift-info-box p-4 mb-4 text-start mx-auto" style="max-width: 400px;">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <div class="d-flex align-items-center gap-2 text-muted fw-medium">
                                        <i class="bi bi-tags"></i> Kategori Shift
                                    </div>
                                    <span class="badge bg-secondary px-3 py-2 rounded-pill">{{ $jadwalHariIni->member->kategori->shift ?? 'Reguler' }}</span>
                                </div>
                                
                                <div class="row text-center g-3">
                                    <div class="col-6 position-relative">
                                        <div class="text-muted small mb-1 fw-medium">Jam Masuk</div>
                                        <div class="fs-3 fw-bold text-main">
                                            {{ $jadwalHariIni->jam_masuk ? \Carbon\Carbon::parse($jadwalHariIni->jam_masuk)->format('H:i') : '--:--' }}
                                        </div>
                                        <div class="position-absolute top-50 end-0 translate-middle-y" style="width: 1px; height: 70%; background-color: #cbd5e1;"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small mb-1 fw-medium">Jam Keluar</div>
                                        <div class="fs-3 fw-bold text-main">
                                            {{ $jadwalHariIni->jam_keluar ? \Carbon\Carbon::parse($jadwalHariIni->jam_keluar)->format('H:i') : '--:--' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($absensiHariIni)
                                <div class="alert badge-info d-flex flex-column align-items-center text-center p-4 mx-auto" style="max-width: 400px; border-radius: var(--radius-lg);">
                                    <div class="bg-white rounded-circle p-3 mb-3 text-info shadow-sm">
                                        <i class="bi bi-check2-circle fs-1 lh-1"></i>
                                    </div>
                                    <h6 class="fw-bold mb-1">Kehadiran Tercatat</h6>
                                    <p class="mb-0 small opacity-75">Status absensi Anda: <strong>{{ strtoupper($absensiHariIni->status) }}</strong></p>
                                </div>
                            @else
                                <form action="{{ route('karyawan.absen.store') }}" method="POST" class="mx-auto" style="max-width: 400px;">
                                    @csrf
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwalHariIni->id }}">
                                    
                                    <button type="submit" class="btn-modern btn-primary-custom w-100 py-3 fs-5 {{ $isBisaAbsen ? 'btn-pulse' : '' }}" {{ $isBisaAbsen ? '' : 'disabled' }}>
                                        <i class="bi bi-fingerprint fs-3"></i>
                                        <span>Catat Kehadiran</span>
                                    </button>
                                    
                                    @if(!$isBisaAbsen)
                                        <div class="text-danger small mt-3 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <i class="bi bi-lock-fill"></i> Saat ini di luar jam operasional absensi
                                        </div>
                                    @else
                                        <div class="text-muted small mt-3 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <i class="bi bi-geo-alt-fill"></i> Pastikan Anda berada di lokasi outlet
                                        </div>
                                    @endif
                                </form>
                            @endif

                        @else
                            <div class="badge-status badge-inactive mb-4">
                                <i class="bi bi-calendar-x-fill"></i> Tidak ada jadwal hari ini
                            </div>

                            <div class="mx-auto py-4 text-center" style="max-width: 300px;">
                                <div class="mb-3">
                                    <i class="bi bi-cup-hot text-muted opacity-50" style="font-size: 4rem;"></i>
                                </div>
                                <h6 class="fw-bold">Selamat Beristirahat!</h6>
                                <p class="text-muted small">Anda tidak memiliki kewajiban absensi atau sedang dalam hari libur.</p>
                            </div>
                        @endif
                    </div>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-3 mx-auto" style="max-width: 400px;">
                        <div class="col-6">
                            <button type="button" class="btn-modern btn-outline-custom w-100" data-bs-toggle="modal" data-bs-target="#modalJadwal">
                                <i class="bi bi-calendar-week fs-5 text-primary"></i>
                                <span class="small">Jadwal Shift</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn-modern btn-outline-custom w-100" data-bs-toggle="modal" data-bs-target="#modalIzin" {{ $adaJadwal && !$absensiHariIni ? '' : 'disabled' }}>
                                <i class="bi bi-envelope-paper fs-5 text-warning"></i>
                                <span class="small">Izin / Sakit</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="modalJadwal" tabindex="-1" aria-labelledby="modalJadwalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom border-0">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-0 text-main" id="modalJadwalLabel">Jadwal Shift</h5>
                        <p class="text-muted small mb-0">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
                    </div>
                    <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="d-flex justify-content-center gap-4 mb-4 bg-light rounded-pill py-2 px-3 small fw-medium">
                        <div class="d-flex align-items-center gap-2"><div class="legend-dot bg-orange" style="background-color: var(--brand-primary);"></div> Masuk</div>
                        <div class="d-flex align-items-center gap-2"><div class="legend-dot bg-danger"></div> Libur</div>
                        <div class="d-flex align-items-center gap-2"><div class="legend-dot bg-secondary"></div> Kosong</div>
                    </div>

                    <div class="calendar-grid">
                        @php
                            $start = Carbon\Carbon::now()->startOfMonth();
                            $daysInMonth = $start->daysInMonth;
                        @endphp
                        
                        @for ($i = 1; $i <= $daysInMonth; $i++)
                            @php
                                $currentDate = $start->copy()->day($i)->toDateString();
                                $hasJadwal = isset($jadwalKalender[$currentDate]);
                                $isLibur = $hasJadwal && $jadwalKalender[$currentDate]['is_libur'];
                                
                                $class = 'day-empty';
                                if($hasJadwal) $class = $isLibur ? 'day-off' : 'day-work';
                            @endphp
                            
                            <div class="calendar-day {{ $class }}" 
                                 onclick="showDetail('{{ $currentDate }}', '{{ $i }}')"
                                 data-info="{{ $hasJadwal ? json_encode($jadwalKalender[$currentDate]) : 'null' }}">
                                {{ $i }}
                            </div>
                        @endfor
                    </div>

                    <div id="detail-jadwal" class="mt-4 p-3 rounded-4 bg-light border d-none" style="transition: all 0.3s ease;">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom border-secondary-subtle">
                            <h6 class="fw-bold mb-0 text-main"><i class="bi bi-info-circle text-primary me-2"></i>Detail Tanggal <span id="detail-tgl-number" class="text-primary"></span></h6>
                            <span id="detail-tgl-full" class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary-subtle"></span>
                        </div>
                        <div id="detail-content" class="pt-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($adaJadwal && !$absensiHariIni)
    <div class="modal fade" id="modalIzin" tabindex="-1" aria-labelledby="modalIzinLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom border-0">
                <form action="{{ route('karyawan.izin.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="jadwal_id" value="{{ $jadwalHariIni->id }}">
                    
                    <div class="modal-header border-bottom-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0 text-main"><i class="bi bi-envelope-paper text-warning me-2"></i> Pengajuan Izin</h5>
                        <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold text-main">Alasan / Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control bg-light border-0 p-3" id="keterangan" name="keterangan" rows="4" style="border-radius: 12px; resize: none;" placeholder="Contoh: Sakit demam (surat dokter menyusul)..." required></textarea>
                        </div>
                        
                        <div class="alert alert-warning border-0 rounded-4 d-flex gap-3 align-items-start mb-0">
                            <i class="bi bi-exclamation-triangle-fill fs-5 mt-1"></i>
                            <div class="small fw-medium">
                                Dengan mengirimkan izin, Anda tidak akan bisa melakukan absen masuk (Hadir) untuk shift hari ini.
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                        <button type="button" class="btn-modern btn-outline-custom px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modern btn-primary-custom px-4">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // 1. Live Clock Function
        function updateClock() {
            const timeElement = document.getElementById('live-time');
            if(timeElement) {
                const now = new Date();
                timeElement.innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace('.', ':');
            }
        }
        setInterval(updateClock, 1000);

        // 2. Auto-hide Toasts
        document.addEventListener('DOMContentLoaded', function () {
            const toasts = document.querySelectorAll('.toast');
            toasts.forEach(toastNode => {
                const toast = new bootstrap.Toast(toastNode, { delay: 5000 });
                toast.show();
            });
        });

        // 3. Calendar Detail Logic
        function showDetail(dateStr, dayNum) {
            const detailBox = document.getElementById('detail-jadwal');
            const titleNum = document.getElementById('detail-tgl-number');
            const titleFull = document.getElementById('detail-tgl-full');
            const content = document.getElementById('detail-content');
            
            // Get data from clicked element
            const dayElement = event.currentTarget;
            const info = JSON.parse(dayElement.getAttribute('data-info'));

            // UI Reset & Show
            detailBox.classList.remove('d-none');
            titleNum.innerText = dayNum;
            titleFull.innerText = dateStr;

            // Render Content
            if (info === null) {
                content.innerHTML = `
                    <div class="text-center py-2 text-muted">
                        <i class="bi bi-calendar-x fs-3 d-block mb-1"></i>
                        <span class="small fw-medium">Belum ada jadwal yang ditetapkan.</span>
                    </div>`;
            } else if (info.is_libur) {
                content.innerHTML = `
                    <div class="text-center py-2 text-danger">
                        <i class="bi bi-emoji-smile fs-3 d-block mb-1"></i>
                        <span class="small fw-bold">Hari Libur Nasional / Cuti</span>
                    </div>`;
            } else {
                content.innerHTML = `
                    <div class="row g-3 small mt-1">
                        <div class="col-6">
                            <div class="text-muted fw-medium mb-1"><i class="bi bi-tags me-1"></i>Shift</div>
                            <div class="fw-bold text-main">${info.shift_name}</div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="text-muted fw-medium mb-1">Status</div>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success-subtle px-2 py-1"><i class="bi bi-briefcase-fill me-1"></i>Masuk</span>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="p-2 rounded bg-white border d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="d-block text-muted" style="font-size: 0.75rem;">Jam Kerja</span>
                                    <span class="fw-bold text-main fs-6">${info.jam_masuk} - ${info.jam_keluar}</span>
                                </div>
                                <div class="text-end">
                                    <span class="d-block text-muted" style="font-size: 0.75rem;">Batas Absen</span>
                                    <span class="fw-semibold text-main">${info.absen_awal} - ${info.absen_akhir}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }
    </script>
</body>
</html>