<?php

namespace App\Http\Controllers\Petugas; // namespace controller untuk petugas

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\Auth; // untuk mengambil data user login
use Illuminate\Support\Facades\Schema; // untuk cek struktur tabel database
use App\Models\User; // model User
use App\Models\Petugas\Buku; // model Buku (petugas)
use App\Models\Petugas\Peminjaman; // model Peminjaman (petugas)

class DashboardController extends Controller
{
    public function index()
    {
        // ================= CEK ROLE =================
        // pastikan hanya user dengan role 'petugas' yang bisa akses
        if (Auth::user()->role !== 'petugas') {
            abort(403); // tampilkan error 403 (forbidden)
        }

        // ================= TOTAL ANGGOTA =================
        // hitung jumlah user dengan role anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // ================= TOTAL BUKU =================
        // hitung semua data buku
        $totalBuku = Buku::count();

        // ================= TOTAL DENDA =================
        // cek apakah kolom 'denda' ada di tabel peminjaman
        // jika ada → jumlahkan semua denda
        // jika tidak → set 0 (biar tidak error)
        $totalDenda = Schema::hasColumn('peminjaman', 'denda') 
                        ? Peminjaman::sum('denda') 
                        : 0;

        // ================= DATA PEMINJAMAN TERBARU =================
        // ambil 5 data peminjaman terbaru beserta relasi:
        // user (anggota), buku, dan petugas
        $peminjaman = Peminjaman::with(['user', 'buku', 'petugas'])
            ->latest() // urut dari yang terbaru
            ->take(5) // ambil 5 data saja
            ->get();

        // ================= KIRIM KE VIEW =================
        // kirim semua data ke dashboard petugas
        return view('dashboard.petugas', compact(
            'totalAnggota',
            'totalBuku',
            'totalDenda',
            'peminjaman'
        ));
    }
}