<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Shift | Key.Flavory.id</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('logo-key.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo-key.png') }}">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7f6; padding-top: 80px; }
        .navbar-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); }
        .btn-orange { background: #fd7e14; color: white; border-radius: 8px; }
        .btn-orange:hover { background: #e86c00; color: white; }
        
        /* Grid Kalender Custom */
        .calendar-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 5px; margin-top: 15px;}
        .day-box { 
            aspect-ratio: 1; border: 1px solid #dee2e6; border-radius: 8px; display: flex; 
            align-items: center; justify-content: center; cursor: pointer; font-weight: 500; user-select: none; transition: 0.1s;
        }
        .day-box:hover:not(.disabled) { background-color: #f8f9fa; }
        .day-box.masuk { background-color: #198754; color: white; border-color: #198754;}
        .day-box.libur { background-color: #dc3545; color: white; border-color: #dc3545;}
        
        /* Box untuk tanggal yang sudah dipakai di shift lain */
        .day-box.disabled { 
            background-color: #e9ecef; color: #adb5bd; border-color: #e9ecef; cursor: not-allowed;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 5px, rgba(0,0,0,0.03) 5px, rgba(0,0,0,0.03) 10px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top py-3 border-bottom">
        <div class="container">
            <a href="{{ route('manager.shift.index') }}" class="navbar-brand fw-bold text-dark"><i class="bi bi-arrow-left me-2"></i> Detail Shift: {{ $shift->shift }}</a>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        @if(session('success')) <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger border-0 shadow-sm">{{ session('error') }}</div> @endif
        @if($errors->any()) <div class="alert alert-danger border-0 shadow-sm">{{ $errors->first() }}</div> @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Anggota Shift</h5>
            <button class="btn btn-orange btn-sm shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#modalAddKaryawan">
                <i class="bi bi-person-plus-fill"></i> Tambah Karyawan
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nama Karyawan</th>
                                <th>Jadwal Terisi</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($shift->members as $m)
                            
                            @php
                                // 1. Ambil data jadwal dari SHIFT INI
                                $currentMasuk = $m->jadwals->whereNotNull('tgl_masuk')->pluck('tgl_masuk')->toArray();
                                $currentLibur = $m->jadwals->whereNotNull('tgl_libur')->pluck('tgl_libur')->toArray();
                                
                                // Ambil contoh jam masuk/keluar dari jadwal terakhir jika ada (untuk pre-fill)
                                $firstJadwal = $m->jadwals->whereNotNull('jam_masuk')->first();
                                $jamData = $firstJadwal ? [
                                    'jam_masuk' => \Carbon\Carbon::parse($firstJadwal->jam_masuk)->format('H:i'),
                                    'jam_keluar' => \Carbon\Carbon::parse($firstJadwal->jam_keluar)->format('H:i'),
                                    'absen_awal' => \Carbon\Carbon::parse($firstJadwal->absen_awal)->format('H:i'),
                                    'absen_akhir' => \Carbon\Carbon::parse($firstJadwal->absen_akhir)->format('H:i'),
                                ] : null;

                                // 2. Ambil data jadwal karyawan dari SHIFT LAIN
                                $otherSchedules = [];
                                foreach($m->karyawan->memberShifts as $otherMember) {
                                    if($otherMember->id !== $m->id) { // Jika bukan shift ini
                                        $otherMasuk = $otherMember->jadwals->whereNotNull('tgl_masuk')->pluck('tgl_masuk')->toArray();
                                        $otherLibur = $otherMember->jadwals->whereNotNull('tgl_libur')->pluck('tgl_libur')->toArray();
                                        $otherSchedules = array_merge($otherSchedules, $otherMasuk, $otherLibur);
                                    }
                                }
                            @endphp

                            <tr>
                                <td class="ps-4 fw-medium">{{ $m->karyawan->nama }}</td>
                                <td><span class="badge bg-secondary">{{ $m->jadwals->count() }} Hari</span></td>
                                <td class="text-center pe-4">
                                    <button class="btn btn-sm btn-outline-primary me-1" onclick='openCalendar("{{ $m->uuid }}", "{{ $m->karyawan->nama }}", @json($currentMasuk), @json($currentLibur), @json($otherSchedules), @json($jamData))'>
                                        <i class="bi bi-calendar-check"></i> Kalender
                                    </button>
                                    <form action="{{ route('manager.shift.member.destroy', $m->uuid) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus karyawan dari shift ini?')"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center py-4 text-muted">Belum ada karyawan di shift ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAddKaryawan" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('manager.shift.add_karyawan', $shift->uuid) }}" method="POST">
                    @csrf
                    <div class="modal-header border-bottom-0"><h5 class="modal-title fw-bold">Pilih Karyawan</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    <div class="modal-body">
                        <label class="form-label">Karyawan Aktif</label>
                        <select name="karyawan_id" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            @foreach($karyawans as $k) <option value="{{ $k->id }}">{{ $k->nama }}</option> @endforeach
                        </select>
                        @if($karyawans->isEmpty()) <small class="text-danger mt-1">Tidak ada karyawan tersedia atau semua sudah masuk di shift ini.</small> @endif
                    </div>
                    <div class="modal-footer border-top-0"><button type="submit" class="btn btn-orange w-100" {{ $karyawans->isEmpty() ? 'disabled' : '' }}>Tambahkan</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalKalender" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow">
                <form action="{{ route('manager.shift.jadwal.store') }}" method="POST" id="formJadwal" onsubmit="prepareSubmit(event)">
                    @csrf
                    <input type="hidden" name="member_uuid" id="targetMemberUuid">
                    <input type="hidden" name="bulan_tahun" id="inputBulanTahun"> <div id="hiddenDateInputs"></div> 

                    <div class="modal-header"><h5 class="modal-title fw-bold">Jadwal: <span id="namaKaryawanSpan" class="text-primary"></span></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                    
                    <div class="modal-body bg-light">
                        <div class="row g-4">
                            <div class="col-md-5">
                                <div class="bg-white p-3 rounded-3 border">
                                    <h6 class="fw-bold mb-3 border-bottom pb-2">Atur Waktu Shift</h6>
                                    <div class="mb-2"><label class="small text-muted">Jam Masuk <span class="text-danger">*</span></label><input type="time" name="jam_masuk" id="inJamMasuk" class="form-control form-control-sm"></div>
                                    <div class="mb-2"><label class="small text-muted">Jam Keluar <span class="text-danger">*</span></label><input type="time" name="jam_keluar" id="inJamKeluar" class="form-control form-control-sm"></div>
                                    <div class="mb-2"><label class="small text-muted">Batas Absen Awal <span class="text-danger">*</span></label><input type="time" name="absen_awal" id="inAbsenAwal" class="form-control form-control-sm"></div>
                                    <div class="mb-2"><label class="small text-muted">Batas Absen Akhir <span class="text-danger">*</span></label><input type="time" name="absen_akhir" id="inAbsenAkhir" class="form-control form-control-sm"></div>
                                </div>
                                <div class="mt-3 bg-white p-3 rounded-3 border">
                                    <h6 class="fw-bold mb-2">Legenda:</h6>
                                    <div class="d-flex align-items-center mb-1"><div style="width:15px; height:15px; background:#198754; border-radius:3px;" class="me-2"></div><small>Masuk Shift Ini</small></div>
                                    <div class="d-flex align-items-center mb-1"><div style="width:15px; height:15px; background:#dc3545; border-radius:3px;" class="me-2"></div><small>Libur</small></div>
                                    <div class="d-flex align-items-center"><div style="width:15px; height:15px; background:#e9ecef; border:1px solid #dee2e6; border-radius:3px;" class="me-2"></div><small>Diambil Shift Lain</small></div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="bg-white p-3 rounded-3 border h-100">
                                    <div class="d-flex justify-content-between mb-3">
                                        <input type="month" id="monthPicker" class="form-control w-50" onchange="generateCalendar()">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="mode" id="modeMasuk" value="masuk" checked>
                                            <label class="btn btn-outline-success btn-sm" for="modeMasuk">Masuk</label>
                                            
                                            <input type="radio" class="btn-check" name="mode" id="modeLibur" value="libur">
                                            <label class="btn btn-outline-danger btn-sm" for="modeLibur">Libur</label>

                                            <input type="radio" class="btn-check" name="mode" id="modeHapus" value="hapus">
                                            <label class="btn btn-outline-secondary btn-sm" for="modeHapus">Clear</label>
                                        </div>
                                    </div>
                                    <div class="text-center text-muted small mb-2">Pilih mode lalu klik tanggal untuk mengatur.</div>
                                    <div id="calendarGrid" class="calendar-grid"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"><button type="submit" class="btn btn-orange px-4">Simpan Jadwal Bulan Ini</button></div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalKalender = new bootstrap.Modal(document.getElementById('modalKalender'));
        
        let selectedDates = { masuk: [], libur: [] }; 
        let otherSchedulesGlobal = []; // Menyimpan jadwal dari shift lain

        function openCalendar(uuid, nama, currentMasuk, currentLibur, otherSchedules, jamData) {
            document.getElementById('targetMemberUuid').value = uuid;
            document.getElementById('namaKaryawanSpan').innerText = nama;
            
            // Masukkan data dari database ke memori UI
            selectedDates.masuk = currentMasuk || [];
            selectedDates.libur = currentLibur || [];
            otherSchedulesGlobal = otherSchedules || [];

            // Pre-fill jam jika data sudah ada
            document.getElementById('inJamMasuk').value = jamData ? jamData.jam_masuk : '';
            document.getElementById('inJamKeluar').value = jamData ? jamData.jam_keluar : '';
            document.getElementById('inAbsenAwal').value = jamData ? jamData.absen_awal : '';
            document.getElementById('inAbsenAkhir').value = jamData ? jamData.absen_akhir : '';
            
            // Set bulan ke bulan saat ini jika kosong, atau biarkan agar tidak berubah
            const now = new Date();
            const monthStr = (now.getMonth() + 1).toString().padStart(2, '0');
            document.getElementById('monthPicker').value = `${now.getFullYear()}-${monthStr}`;
            
            generateCalendar();
            modalKalender.show();
        }

        function generateCalendar() {
            const picker = document.getElementById('monthPicker').value;
            if(!picker) return;
            
            let [currentYear, currentMonth] = picker.split('-');
            const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
            const grid = document.getElementById('calendarGrid');
            grid.innerHTML = '';

            for (let i = 1; i <= daysInMonth; i++) {
                const dayStr = i.toString().padStart(2, '0');
                const fullDate = `${currentYear}-${currentMonth}-${dayStr}`;
                
                const box = document.createElement('div');
                box.className = 'day-box';
                box.innerText = i;
                box.dataset.date = fullDate;

                // VALIDASI FRONTEND: Cek apakah tanggal ini dipakai di shift LAIN
                if (otherSchedulesGlobal.includes(fullDate)) {
                    box.classList.add('disabled');
                    box.title = "Karyawan sudah ditugaskan ke shift lain di tanggal ini";
                } else {
                    // Beri event onclick hanya jika tanggal tersedia
                    box.onclick = () => toggleDate(box, fullDate);

                    // Restore state UI untuk shift INI
                    if(selectedDates.masuk.includes(fullDate)) box.classList.add('masuk');
                    else if(selectedDates.libur.includes(fullDate)) box.classList.add('libur');
                }

                grid.appendChild(box);
            }
        }

        function toggleDate(box, date) {
            const mode = document.querySelector('input[name="mode"]:checked').value;
            
            // Hapus dari memori UI terlebih dahulu
            selectedDates.masuk = selectedDates.masuk.filter(d => d !== date);
            selectedDates.libur = selectedDates.libur.filter(d => d !== date);
            box.classList.remove('masuk', 'libur');

            // Set state baru
            if(mode === 'masuk') {
                selectedDates.masuk.push(date);
                box.classList.add('masuk');
            } else if(mode === 'libur') {
                selectedDates.libur.push(date);
                box.classList.add('libur');
            }
        }

        // PERUBAHAN 3: Fungsi prepareSubmit sekarang menerima param 'event' dan melakukan validasi wajib isi Waktu Shift
        function prepareSubmit(event) {
            const bulanTahun = document.getElementById('monthPicker').value;
            
            // Filter agar HANYA mengirim tanggal dari bulan yang sedang dilihat di kalender
            const filterMonth = (dateStr) => dateStr.startsWith(bulanTahun);
            const masukDates = selectedDates.masuk.filter(filterMonth);
            const liburDates = selectedDates.libur.filter(filterMonth);

            // ================= VALIDASI REQUIRED JIKA ADA TANGGAL MASUK =================
            if (masukDates.length > 0) {
                const jamMasuk = document.getElementById('inJamMasuk').value;
                const jamKeluar = document.getElementById('inJamKeluar').value;
                const absenAwal = document.getElementById('inAbsenAwal').value;
                const absenAkhir = document.getElementById('inAbsenAkhir').value;

                if (!jamMasuk || !jamKeluar || !absenAwal || !absenAkhir) {
                    event.preventDefault(); // Mencegah form tersubmit, modal akan tetap TERBUKA
                    alert('Mohon isi lengkap Waktu Shift (Jam Masuk, Keluar, Absen Awal, dan Absen Akhir) jika ada jadwal "Masuk" yang dipilih!');
                    return false;
                }
            }
            // ============================================================================

            document.getElementById('inputBulanTahun').value = bulanTahun;
            const container = document.getElementById('hiddenDateInputs');
            container.innerHTML = ''; 

            masukDates.forEach(date => {
                container.innerHTML += `<input type="hidden" name="tgl_masuk[]" value="${date}">`;
            });

            liburDates.forEach(date => {
                container.innerHTML += `<input type="hidden" name="tgl_libur[]" value="${date}">`;
            });
        }
    </script>
</body>
</html>