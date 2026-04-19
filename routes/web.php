<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,ManagerController,RegisterController,VerifikasiManagerController,
ManagerKaryawanController, ManagerShiftController, ManagerAbsensiController, ManagerAkunController, PublicController};
use App\Http\Controllers\{KaryawanController};

Route::get('/', [PublicController::class, 'index'])->name('index');
// Form Registrasi
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/verifikasi-manager/{uuid}', [VerifikasiManagerController::class, 'showForm'])->name('verifikasi.manager.show');
Route::post('/verifikasi-manager/{uuid}', [VerifikasiManagerController::class, 'verify'])->name('verifikasi.manager.process');

// Route AJAX Validasi (Dibuat method GET agar mudah diakses dari fetch API JS)
Route::get('/check-availability', [RegisterController::class, 'checkAvailability']);

Route::get('/tentang', [PublicController::class, 'tentang'])->name('tentang');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/syarat-ketentuan', [PublicController::class, 'SyaratKetentuan'])->name('syarat-ketentuan');
Route::get('/kebijakan-privasi', [PublicController::class, 'KebijakanPrivasi'])->name('kebijakan-privasi');

// Middleware untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::prefix('panduan')->name('panduan.')->group(function () {
    Route::view('/daftar', 'panduan.daftar')->name('daftar');
    Route::view('/login', 'panduan.login')->name('login');
    Route::view('/data-karyawan', 'panduan.data-karyawan')->name('data-karyawan');
    Route::view('/shift-karyawan', 'panduan.shift-karyawan')->name('shift-karyawan');
    Route::view('/absensi-karyawan', 'panduan.absensi-karyawan')->name('absensi-karyawan');
    Route::view('/karyawan', 'panduan.karyawan')->name('karyawan');
});

// Middleware untuk Auth (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Middleware khusus untuk Auth DAN Role Manager
Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::prefix('manager/karyawan')->name('manager.karyawan.')->group(function () {
        Route::get('/', [ManagerKaryawanController::class, 'index'])->name('index');
        Route::get('/aktif', [ManagerKaryawanController::class, 'aktif'])->name('aktif');
        Route::post('/store', [ManagerKaryawanController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ManagerKaryawanController::class, 'update'])->name('update');
        Route::post('/nonaktifkan/{id}', [ManagerKaryawanController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::get('/nonaktif', [ManagerKaryawanController::class, 'nonaktif'])->name('nonaktif');
        Route::post('/aktifkan/{id}', [ManagerKaryawanController::class, 'aktifkan'])->name('aktifkan');
        Route::get('/akun', [ManagerKaryawanController::class, 'akun'])->name('akun');
        Route::post('/akun', [ManagerKaryawanController::class, 'storeAkun'])->name('akun.store');
        Route::get('/check-availability', [ManagerKaryawanController::class, 'checkAvailability'])->name('check');
    });
    Route::prefix('manager/shift')->name('manager.shift.')->group(function () {
        Route::get('/', [ManagerShiftController::class, 'index'])->name('index');
        Route::post('/', [ManagerShiftController::class, 'storeKategori'])->name('store');
        Route::post('/jadwal', [ManagerShiftController::class, 'storeJadwal'])->name('jadwal.store');
        Route::get('/{uuid}', [ManagerShiftController::class, 'detail'])->name('detail');
        Route::post('/{uuid}/add-karyawan', [ManagerShiftController::class, 'addKaryawan'])->name('add_karyawan');
        Route::delete('/member/{uuid}', [ManagerShiftController::class, 'destroyMember'])->name('member.destroy');
    });
    Route::prefix('manager/absensi')->name('manager.absensi.')->group(function () {
        Route::get('/', [ManagerAbsensiController::class, 'index'])->name('index');
        Route::post('/toggle-kamera', [ManagerAbsensiController::class, 'updateToggle'])->name('toggle');
    });
    Route::post('/manager/generate-key', [ManagerController::class, 'generateKey'])->name('manager.generate_key');
    Route::prefix('manager/profile')->name('manager.profile.')->group(function () {
        Route::get('/', [ManagerAkunController::class, 'index'])->name('index');
        Route::post('/update', [ManagerAkunController::class, 'updateProfile'])->name('update');
        Route::post('/update-akun', [ManagerAkunController::class, 'updateAkun'])->name('update_akun');
    });
    Route::get('/manager/check-username', [ManagerAkunController::class, 'checkUsername'])->name('manager.check_username');
    

});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    // Sesuaikan ini dengan Controller Karyawan Anda nantinya
    Route::get('/karyawan/index', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan/absen', [KaryawanController::class, 'storeAbsen'])->name('karyawan.absen.store');
    Route::post('/karyawan/izin', [KaryawanController::class, 'storeIzin'])->name('karyawan.izin.store');
});