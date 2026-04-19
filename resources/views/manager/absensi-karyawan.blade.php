<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Karyawan | Key.Flavory.id</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding-top: 80px; }
        .navbar-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
        .btn-orange { background: #fd7e14; color: white; border-radius: 8px; font-weight: 500;}
        .btn-orange:hover { background: #e86c00; color: white; }
        
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; margin-top: 15px;}
        .day-box { 
            aspect-ratio: 1; border-radius: 8px; display: flex; flex-direction: column;
            align-items: center; justify-content: center; font-weight: 600; font-size: 1rem;
            transition: 0.2s; position: relative; border: 1px solid #dee2e6; color: #495057; background: #e9ecef;
        }
        
        .box-absen { background-color: #198754; color: white; border-color: #198754; }
        .box-mangkir { background-color: #dc3545; color: white; border-color: #dc3545; }
        .box-izin { background-color: #fd7e14; color: white; border-color: #fd7e14; }
        .box-libur { background-color: #0d6efd; color: white; border-color: #0d6efd; }
        .box-belum { background-color: #fff; color: #6c757d; border-style: dashed; }
        
        .legend-dot { width: 14px; height: 14px; border-radius: 4px; display: inline-block; margin-right: 6px; }
        .day-box { 
            cursor: pointer;
        }
        .day-box:hover {
            transform: scale(1.05);
            z-index: 5;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
        }
        .xsmall { font-size: 0.75rem; }

        /* Custom Toggle Switch Style */
        .form-switch .form-check-input {
            width: 2.5em; height: 1.25em; cursor: pointer;
        }
        .form-switch .form-check-input:checked {
            background-color: #fd7e14; border-color: #fd7e14;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3 border-bottom shadow-sm">
        <div class="container">
            <a href="{{ route('manager.index') }}" class="navbar-brand fw-bold text-dark"><i class="bi bi-arrow-left me-2"></i> Rekap Absensi</a>
        </div>
    </nav>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080; margin-top: 70px;">
        <div id="actionToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-medium" id="toastMessage">
                    </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h5 class="fw-bold mb-1 text-dark"><i class="bi bi-camera-fill me-2 text-warning"></i>Pengaturan Bukti Absen & Izin</h5>
                    <p class="text-muted small mb-0">Aktifkan/nonaktifkan wajib foto saat karyawan melakukan absensi atau mengajukan izin.</p>
                </div>
                <div class="d-flex flex-wrap gap-4 bg-light p-3 rounded-4 border">
                    <div class="form-check form-switch d-flex align-items-center mb-0">
                        <input class="form-check-input me-2 mt-0" type="checkbox" role="switch" id="toggleAbsen" onchange="updateToggle('absen', this.checked)" {{ $pengaturan->kamera_absen ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold text-dark" style="cursor: pointer" for="toggleAbsen">Kamera Absen</label>
                    </div>
                    <div class="form-check form-switch d-flex align-items-center mb-0">
                        <input class="form-check-input me-2 mt-0" type="checkbox" role="switch" id="toggleIzin" onchange="updateToggle('izin', this.checked)" {{ $pengaturan->kamera_izin ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold text-dark" style="cursor: pointer" for="toggleIzin">Kamera Izin</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form action="{{ route('manager.absensi.index') }}" method="GET" class="d-flex gap-2">
                    <select name="bulan" class="form-select border-0 bg-light" style="width: 150px;">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == sprintf('%02d', $m) ? 'selected' : '' }}>
                                {{ date('F', mktime(0,0,0,$m,1)) }}
                            </option>
                        @endfor
                    </select>
                    <select name="tahun" class="form-select border-0 bg-light" style="width: 120px;">
                        @for($y=date('Y')-1; $y<=date('Y')+1; $y++)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-secondary px-3">Terapkan</button>
                </form>

                <form action="{{ route('manager.absensi.index') }}" method="GET">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="export" value="excel">
                    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4">
                        <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                    </button>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 py-3">Nama Karyawan</th>
                                <th>Username</th>
                                <th>Total Absen</th>
                                <th>Total Mangkir</th>
                                <th>Total Izin</th>
                                <th class="text-center pe-4">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataAbsensi as $data)
                            <tr>
                                <td class="ps-4 fw-medium">{{ $data['nama'] }}</td>
                                <td><code>{{ $data['username'] }}</code></td>
                                <td><span class="badge bg-success bg-opacity-10 text-success border border-success-subtle">{{ $data['total_absen'] }}</span></td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger border border-danger-subtle">{{ $data['total_mangkir'] }}</span></td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning border border-warning-subtle">{{ $data['total_izin'] }}</span></td>
                                <td class="text-center pe-4">
                                    <button class="btn btn-sm btn-outline-dark shadow-sm px-3 rounded-pill" onclick='openCalendar(@json($data), {{ $daysInMonth }}, "{{ $bulan }}", "{{ $tahun }}")'>
                                        <i class="bi bi-calendar3"></i> Kalender
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-4 text-muted">Belum ada data karyawan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKalender" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <div>
                        <h5 class="modal-title fw-bold" id="namaKaryawanModal"></h5>
                        <p class="text-muted small mb-0">Periode: <span id="periodeModal" class="fw-semibold"></span></p>
                        <p class="text-primary xsmall fw-medium mb-0 mt-1"><i class="bi bi-info-circle me-1"></i>Klik tanggal untuk lihat detail foto</p>
                    </div>
                    <button type="button" class="btn-close bg-light rounded-circle p-2" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="calendarGrid" class="calendar-grid"></div>

                    <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-3 small text-muted fw-medium">
                        <div><span class="legend-dot bg-success"></span>Absen</div>
                        <div><span class="legend-dot bg-danger"></span>Mangkir</div>
                        <div><span class="legend-dot" style="background:#fd7e14;"></span>Izin</div>
                        <div><span class="legend-dot bg-primary"></span>Libur</div>
                        <div><span class="legend-dot" style="background:#e9ecef; border:1px solid #dee2e6;"></span>Kosong</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailHarian" tabindex="-1" style="z-index: 1060;">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-light border-0">
                    <h6 class="modal-title fw-bold text-dark" id="detailTanggalTitle">Detail Absensi</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <div id="detailContent"></div>
                </div>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // AJAX Toggle Fungsi
    function updateToggle(jenis, isChecked) {
        fetch("{{ route('manager.absensi.toggle') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                jenis: jenis,
                status: isChecked ? 1 : 0
            })
        })
        .then(response => response.json())
        .then(data => {
            const toastEl = document.getElementById('actionToast');
            const toastBody = document.getElementById('toastMessage');
            
            if(data.success) {
                toastEl.classList.remove('bg-danger');
                toastEl.classList.add('bg-success');
                toastBody.innerHTML = `<i class="bi bi-check-circle me-2"></i> ${data.message}`;
            } else {
                toastEl.classList.remove('bg-success');
                toastEl.classList.add('bg-danger');
                toastBody.innerHTML = `<i class="bi bi-exclamation-triangle me-2"></i> Gagal memperbarui pengaturan.`;
                // Revert toggle visually if failed
                document.getElementById('toggle' + (jenis === 'absen' ? 'Absen' : 'Izin')).checked = !isChecked;
            }
            
            const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
        })
        .catch(error => {
            console.error('Error:', error);
            // Revert toggle visually
            document.getElementById('toggle' + (jenis === 'absen' ? 'Absen' : 'Izin')).checked = !isChecked;
        });
    }

    const modalKalenderElem = document.getElementById('modalKalender');
    const modalKalender = new bootstrap.Modal(modalKalenderElem);
    
    const modalDetailElem = document.getElementById('modalDetailHarian');
    const modalDetail = new bootstrap.Modal(modalDetailElem);
    
    function openCalendar(data, daysInMonth, bulan, tahun) {
        document.getElementById('namaKaryawanModal').innerText = data.nama;
        
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const namaBulan = monthNames[parseInt(bulan)-1];
        document.getElementById('periodeModal').innerText = `${namaBulan} ${tahun}`;
        
        const grid = document.getElementById('calendarGrid');
        grid.innerHTML = '';

        for (let i = 1; i <= daysInMonth; i++) {
            const dayData = data.calendar[i];
            const box = document.createElement('div');
            box.className = 'day-box shadow-sm';
            box.innerText = i;

            if (dayData.status === 'absen') box.classList.add('box-absen');
            else if (dayData.status === 'mangkir') box.classList.add('box-mangkir');
            else if (dayData.status === 'libur') box.classList.add('box-libur');
            else if (dayData.status === 'belum') box.classList.add('box-belum');
            else if (dayData.status === 'izin') box.classList.add('box-izin');

            box.onclick = function() {
                showDetailHarian(i, namaBulan, tahun, dayData);
            };
            
            grid.appendChild(box);
        }

        modalKalender.show();
    }

    function showDetailHarian(tgl, bulan, tahun, info) {
        const title = document.getElementById('detailTanggalTitle');
        const content = document.getElementById('detailContent');
        
        title.innerText = `${tgl} ${bulan} ${tahun}`;
        let htmlContent = '';
        let photoHtml = '';

        // Generate Image Preview Logic
        if (info.status === 'absen' || info.status === 'izin') {
            if (info.foto) {
                photoHtml = `
                    <div class="mt-3 pt-3 border-top text-start">
                        <p class="mb-2 fw-semibold text-dark small"><i class="bi bi-image text-primary me-1"></i> Foto Bukti:</p>
                        <a href="{{ asset('') }}${info.foto}" target="_blank" title="Klik untuk memperbesar">
                            <img src="{{ asset('') }}${info.foto}" class="img-fluid rounded-3 shadow-sm w-100" style="max-height: 200px; object-fit: cover; cursor: zoom-in;" alt="Bukti Foto">
                        </a>
                    </div>
                `;
            } else {
                photoHtml = `
                    <div class="mt-3 pt-3 border-top text-start">
                        <p class="mb-2 fw-semibold text-dark small"><i class="bi bi-image text-secondary me-1"></i> Foto Bukti:</p>
                        <div class="p-3 bg-light rounded-3 border border-dashed text-center border-secondary-subtle">
                            <i class="bi bi-camera-video-off text-muted opacity-50 d-block fs-3 mb-1"></i>
                            <span class="text-muted small fw-medium">Tidak ada foto</span>
                        </div>
                    </div>
                `;
            }
        }

        switch(info.status) {
            case 'absen':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i></div>
                    <p class="mb-0 fs-5 fw-bold text-success">Hadir</p>
                    <p class="text-muted mb-0">Tercatat pukul ${info.ket || '--:--'}</p>
                    ${photoHtml}
                `;
                break;
            case 'izin':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-info-circle-fill text-warning" style="font-size: 3rem;"></i></div>
                    <p class="mb-0 fs-5 fw-bold text-warning">Izin / Sakit</p>
                    <p class="text-muted mb-0 fst-italic">"${info.ket || 'Tanpa keterangan'}"</p>
                    ${photoHtml}
                `;
                break;
            case 'mangkir':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i></div>
                    <p class="mb-0 fs-5 fw-bold text-danger">Mangkir</p>
                    <p class="text-muted small mb-0">Tidak hadir tanpa keterangan.</p>
                `;
                break;
            case 'libur':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-calendar-event text-primary" style="font-size: 3rem;"></i></div>
                    <p class="mb-0 fs-5 fw-bold text-primary">Libur</p>
                `;
                break;
            default:
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-dash-circle text-secondary" style="font-size: 3rem;"></i></div>
                    <p class="text-muted mb-0">Belum ada data / Tidak ada jadwal.</p>
                `;
        }

        content.innerHTML = htmlContent;
        modalDetail.show();
    }
    </script>
</body>
</html>