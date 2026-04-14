<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi Karyawan | Key.Flavory.id</title>
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
        .box-izin { background-color: #fd7e14; color: white; border-color: #fd7e14; cursor: pointer; }
        .box-libur { background-color: #0d6efd; color: white; border-color: #0d6efd; }
        .box-belum { background-color: #fff; color: #6c757d; border-style: dashed; }
        
        .legend-dot { width: 14px; height: 14px; border-radius: 4px; display: inline-block; margin-right: 6px; }
        .day-box { 
        cursor: pointer; /* Memberi indikasi bisa diklik */
        }
        .day-box:hover {
            transform: scale(1.05);
            z-index: 5;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
        }
        .xsmall { font-size: 0.75rem; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3 border-bottom">
        <div class="container">
            <a href="{{ route('manager.index') }}" class="navbar-brand fw-bold text-dark"><i class="bi bi-arrow-left me-2"></i> Rekap Absensi</a>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body p-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form action="{{ route('manager.absensi.index') }}" method="GET" class="d-flex gap-2">
                    <select name="bulan" class="form-select" style="width: 150px;">
                        @for($m=1; $m<=12; $m++)
                            <option value="{{ sprintf('%02d', $m) }}" {{ $bulan == sprintf('%02d', $m) ? 'selected' : '' }}>
                                {{ date('F', mktime(0,0,0,$m,1)) }}
                            </option>
                        @endfor
                    </select>
                    <select name="tahun" class="form-select" style="width: 120px;">
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
                    <button type="submit" class="btn btn-success shadow-sm">
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
                                <th class="ps-4">Nama Karyawan</th>
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
                                <td><span class="badge bg-success bg-opacity-10 text-success">{{ $data['total_absen'] }}</span></td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger">{{ $data['total_mangkir'] }}</span></td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning">{{ $data['total_izin'] }}</span></td>
                                <td class="text-center pe-4">
                                    <button class="btn btn-sm btn-outline-primary shadow-sm px-3" onclick='openCalendar(@json($data), {{ $daysInMonth }}, "{{ $bulan }}", "{{ $tahun }}")'>
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
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-bottom-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold" id="namaKaryawanModal"></h5>
                    <p class="text-muted small mb-0">Periode: <span id="periodeModal"></span></p>
                    <p class="text-primary xsmall fw-medium mb-0 mt-1"><i class="bi bi-info-circle me-1"></i>Klik tanggal untuk lihat detail</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="calendarGrid" class="calendar-grid"></div>

                <div class="mt-4 pt-3 border-top d-flex flex-wrap gap-3 small text-muted">
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
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h6 class="modal-title fw-bold" id="detailTanggalTitle">Detail Absensi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div id="detailContent">
                    </div>
            </div>
        </div>
    </div>
</div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

            // Mapping Warna Berdasarkan Status
            if (dayData.status === 'absen') box.classList.add('box-absen');
            else if (dayData.status === 'mangkir') box.classList.add('box-mangkir');
            else if (dayData.status === 'libur') box.classList.add('box-libur');
            else if (dayData.status === 'belum') box.classList.add('box-belum');
            else if (dayData.status === 'izin') box.classList.add('box-izin');

            // Event Klik pada Kotak Tanggal
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

        // Logika tampilan berdasarkan status sesuai instruksi
        switch(info.status) {
            case 'absen':
                // info.ket biasanya berisi jam (misal: "08:00") dari controller
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-check-circle-fill text-success fs-1"></i></div>
                    <p class="mb-0 fw-bold text-success">Status: Hadir</p>
                    <p class="text-muted">Absen pada pukul ${info.ket || '--:--'}</p>
                `;
                break;
            case 'izin':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-info-circle-fill text-warning fs-1"></i></div>
                    <p class="mb-0 fw-bold text-warning">Status: Izin</p>
                    <p class="text-muted italic">"${info.ket || 'Tidak ada keterangan'}"</p>
                `;
                break;
            case 'mangkir':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-x-circle-fill text-danger fs-1"></i></div>
                    <p class="mb-0 fw-bold text-danger">Status: Mangkir</p>
                    <p class="text-muted small">Karyawan tidak hadir tanpa keterangan.</p>
                `;
                break;
            case 'libur':
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-calendar-event text-primary fs-1"></i></div>
                    <p class="mb-0 fw-bold text-primary">Status: Libur</p>
                `;
                break;
            default:
                htmlContent = `
                    <div class="mb-2"><i class="bi bi-dash-circle text-secondary fs-1"></i></div>
                    <p class="text-muted">Tidak ada jadwal atau data absensi pada tanggal ini.</p>
                `;
        }

        content.innerHTML = htmlContent;
        modalDetail.show();
    }
    </script>
</body>
</html>