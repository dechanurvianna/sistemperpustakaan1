<?php

use App\Http\Controllers\Anggota\CariBukuController;
use App\Http\Controllers\Anggota\PeminjamanController;
use App\Http\Controllers\Anggota\PengembalianController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ================= AUTH =================
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/lupa-password', function () {
    return view('auth.lupa_password');
})->name('lupa.password');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= DASHBOARD =================
Route::get('/dashboard-anggota', function () {
    if (!session('user_id') || session('role') != 'anggota') {
        return redirect('/login');
    }
    return view('dashboard.anggota');
})->name('dashboard.anggota');

Route::get('/dashboard-petugas', function () {
    if (!session('user_id') || session('role') != 'petugas') {
        return redirect('/login');
    }
    return view('dashboard.petugas');
})->name('dashboard.petugas');

Route::get('/dashboard-kepala', function () {
    if (!session('user_id') || session('role') != 'kepala') {
        return redirect('/login');
    }
    return view('dashboard.kepala');
})->name('dashboard.kepala');


// ================= CARI BUKU =================
Route::get('/cari-buku', [CariBukuController::class, 'cari'])
    ->name('cari.buku');

Route::post('/cari-buku', [CariBukuController::class, 'hasil'])
    ->name('cari.buku.hasil');

Route::get('/buku/{id}', [CariBukuController::class, 'detail'])
    ->name('buku.detail');


// ================= PEMINJAMAN =================
Route::get('/peminjaman', [PeminjamanController::class, 'index'])
    ->name('peminjaman.index');

Route::get('/peminjaman/create/{id}', [PeminjamanController::class, 'create'])
    ->name('peminjaman.create');

Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])
    ->name('peminjaman.store');

Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])
    ->name('peminjaman.show');

Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])
    ->name('peminjaman.destroy');


// ================= PENGEMBALIAN =================
Route::get('/pengembalian', [PengembalianController::class, 'index'])
    ->name('pengembalian.index');

//PETUGAS

