<button class="btn btn-orange d-lg-none position-fixed bottom-0 end-0 m-4 z-3 shadow-lg rounded-circle d-flex align-items-center justify-content-center" 
        type="button" 
        data-bs-toggle="offcanvas" 
        data-bs-target="#sidebarPanduan" 
        aria-controls="sidebarPanduan"
        style="width: 60px; height: 60px; z-index: 1050;">
    <i class="bi bi-list fs-3 text-white"></i>
</button>

<style>
    :root {
        --kf-orange: #fd7e14;
        --kf-orange-light: #fff4e6;
    }
    
    .sidebar-wrapper {
        width: 280px;
        min-height: 100vh;
        background-color: #ffffff;
    }

    .sidebar-link {
        color: #495057;
        padding: 10px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        margin-bottom: 5px;
    }

    .sidebar-link i {
        margin-right: 10px;
        font-size: 1.1rem;
        color: #6c757d;
        transition: all 0.2s ease;
    }

    .sidebar-link:hover {
        background-color: #f8f9fa;
        color: var(--kf-orange);
    }

    .sidebar-link:hover i {
        color: var(--kf-orange);
    }

    /* Active State */
    .sidebar-link.active {
        background-color: var(--kf-orange-light);
        color: var(--kf-orange);
        font-weight: 600;
        border-left: 4px solid var(--kf-orange);
    }

    .sidebar-link.active i {
        color: var(--kf-orange);
    }

    .sidebar-heading {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #adb5bd;
        margin: 20px 0 10px 15px;
    }
    
    .btn-orange { background-color: var(--kf-orange) !important; color: white !important; border: none; }
</style>

<div class="offcanvas-lg offcanvas-start border-end shadow-sm sidebar-wrapper" tabindex="-1" id="sidebarPanduan" aria-labelledby="sidebarPanduanLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold text-dark d-flex align-items-center" id="sidebarPanduanLabel">
            <i class="bi bi-book-half text-orange me-2"></i> Pusat Bantuan
        </h5>
        <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarPanduan" aria-label="Close"></button>
    </div>
    
    <div class="offcanvas-body flex-column p-3">
        <div class="mb-4 px-2 d-none d-lg-block">
            <h4 class="fw-bold text-dark mb-0">Key.<span class="text-orange">Flavory</span></h4>
            <small class="text-muted">HRMS Documentation</small>
        </div>

        <div class="sidebar-heading">Memulai</div>
        <nav class="nav flex-column mb-3">
            <a href="{{ route('panduan.daftar') }}" class="sidebar-link {{ request()->routeIs('panduan.daftar') ? 'active' : '' }}">
                <i class="bi bi-person-vcard"></i> Pendaftaran Akun
            </a>
            <a href="{{ route('panduan.login') }}" class="sidebar-link {{ request()->routeIs('panduan.login') ? 'active' : '' }}">
                <i class="bi bi-box-arrow-in-right"></i> Cara Log In
            </a>
        </nav>

        <div class="sidebar-heading">Panduan Manager</div>
        <nav class="nav flex-column mb-3">
            <a href="{{ route('panduan.data-karyawan') }}" class="sidebar-link {{ request()->routeIs('panduan.data-karyawan') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola Data Karyawan
            </a>
            <a href="{{ route('panduan.shift-karyawan') }}" class="sidebar-link {{ request()->routeIs('panduan.shift-karyawan') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> Manajemen Shift
            </a>
            <a href="{{ route('panduan.absensi-karyawan') }}" class="sidebar-link {{ request()->routeIs('panduan.absensi-karyawan') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph"></i> Rekap Absensi
            </a>
        </nav>

        <div class="sidebar-heading">Panduan Karyawan</div>
        <nav class="nav flex-column mb-4">
            <a href="{{ route('panduan.karyawan') }}" class="sidebar-link {{ request()->routeIs('panduan.karyawan') ? 'active' : '' }}">
                <i class="bi bi-person-workspace"></i> Fitur & Absensi
            </a>
        </nav>

        <div class="mt-auto p-3 bg-light rounded text-center border">
            <i class="bi bi-headset text-orange fs-4 mb-2 d-block"></i>
            <p class="small text-muted mb-2">Butuh bantuan teknis lebih lanjut?</p>
            <a href="#" class="btn btn-sm btn-outline-secondary w-100 rounded-pill">Hubungi Support</a>
        </div>
    </div>
</div>