<?php

use App\Http\Controllers\Anggota\CariBukuController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboard;
use App\Http\Controllers\Anggota\PeminjamanController;
use App\Http\Controllers\Anggota\PengembalianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboard;
use App\Http\Controllers\Kepala\DataBukuController;
use App\Http\Controllers\Kepala\LaporanController;
use App\Http\Controllers\Kepala\PeminjamanController as KepalaPermintaanPeminjaman;
use App\Http\Controllers\Kepala\PengembalianController as KepalaPermintaanPengembalian;
use App\Http\Controllers\Kepala\PetugasController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\DataAnggotaController;
use App\Http\Controllers\Petugas\DataBukuController as PetugasDataBukuController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjaman;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalian;
use App\Http\Controllers\Petugas\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // ================= ANGGOTA =================
    Route::prefix('anggota')->name('anggota.')->group(function () {

        Route::get('/dashboard', [AnggotaDashboard::class, 'index'])->name('dashboard');

        Route::get('/cari-buku', [CariBukuController::class, 'cari'])->name('cari-buku');
        Route::get('/buku/{id}', [CariBukuController::class, 'detail'])->name('buku.detail');

        Route::prefix('peminjaman')->name('peminjaman.')->group(function () {

            Route::get('/', [PeminjamanController::class, 'index'])->name('index');

            Route::get('/create/{id}', [PeminjamanController::class, 'create'])->name('create');
            Route::post('/store', [PeminjamanController::class, 'store'])->name('store');

            Route::get('/pengembalian/{id}', [PeminjamanController::class, 'formPengembalian'])->name('formPengembalian');
            Route::post('/pengembalian/{id}', [PeminjamanController::class, 'ajukanPengembalian'])->name('ajukan');

            Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');

            Route::get('/{id}', [PeminjamanController::class, 'show'])->name('show');

        }); // ✅ FIX: ini yang tadi kurang
    });


    // ================= PETUGAS =================
    Route::prefix('petugas')->name('petugas.')->group(function () {

        Route::get('/dashboard', [PetugasDashboard::class, 'index'])->name('dashboard');

        Route::get('/data-buku', [PetugasDataBukuController::class, 'index'])->name('data-buku');
        Route::get('/buku/create', [PetugasDataBukuController::class, 'create'])->name('buku.create');
        Route::post('/buku/store', [PetugasDataBukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}', [PetugasDataBukuController::class, 'show'])->name('buku.show');
        Route::get('/buku/edit/{id}', [PetugasDataBukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/update/{id}', [PetugasDataBukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/delete/{id}', [PetugasDataBukuController::class, 'destroy'])->name('buku.delete');

        Route::get('/peminjaman', [PetugasPeminjaman::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman/acc/{id}', [PetugasPeminjaman::class, 'acc'])->name('peminjaman.acc');
        Route::post('/peminjaman/tolak/{id}', [PetugasPeminjaman::class, 'tolak'])->name('peminjaman.tolak');

        Route::get('/pengembalian', [PetugasPengembalian::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian/{id}/konfirmasi', [PetugasPengembalian::class, 'konfirmasi'])->name('pengembalian.konfirmasi');

        Route::get('/data-anggota', [DataAnggotaController::class, 'index'])->name('data-anggota');
        Route::delete('/anggota/delete/{id}', [DataAnggotaController::class, 'destroy'])->name('anggota.delete');

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });


    // ================= KEPALA =================
    Route::prefix('kepala')->name('kepala.')->group(function () {

        Route::get('/dashboard', [KepalaDashboard::class, 'index'])->name('dashboard');

         Route::get('/laporan', [LaporanController::class, 'laporan']) ->name('laporan');

         // PETUGAS (CRUD)
         Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
         Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
         Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
         Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit'])->name('petugas.edit');
         Route::delete('/petugas/delete/{id}', [PetugasController::class, 'destroy'])->name('petugas.delete');
        Route::put('/petugas/update/{id}', [PetugasController::class, 'update'])->name('petugas.update');

        // PEMINJAMAN (READ-ONLY)
        Route::get('/peminjaman', [KepalaPermintaanPeminjaman::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/{id}', [KepalaPermintaanPeminjaman::class, 'show'])->name('peminjaman.show');

        // PENGEMBALIAN (READ-ONLY)
        Route::get('/pengembalian', [KepalaPermintaanPengembalian::class, 'index'])->name('pengembalian.index');
        Route::get('/pengembalian/{id}', [KepalaPermintaanPengembalian::class, 'show'])->name('pengembalian.show');

        //DATA BUKU(KATALOG)
        Route::get('/katalog', [DataBukuController::class, 'index'])->name('katalog');
        });
});
