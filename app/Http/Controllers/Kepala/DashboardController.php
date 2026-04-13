<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk kepala (admin utama)

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung
use Carbon\Carbon;  // untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
       // ================= TOTAL BUKU =================
        // menghitung jumlah seluruh data buku di tabel buku
        $totalBuku = DB::table('buku')->count();

        // ================= TOTAL ANGGOTA =================
        // menghitung jumlah user dengan role anggota
        $totalAnggota = DB::table('users')->where('role', 'anggota')->count();

        // ================= BUKU DIPINJAM =================
        // menghitung jumlah buku yang statusnya sedang dipinjam
        $bukuDipinjam = DB::table('peminjaman')->where('status', 'dipinjam')->count();

         // ================= BUKU TERLAMBAT =================
        // menghitung jumlah buku yang:
        // - status masih dipinjam
        // - tanggal jatuh tempo sudah lewat dari hari ini
        $terlambat = DB::table('peminjaman')
                        ->where('status', 'dipinjam')
                        ->where('jatuh_tempo', '<', Carbon::today())
                        ->count();

        // ================= AKTIVITAS TERBARU =================
        // ambil 10 transaksi peminjaman terbaru
        $aktivitas = DB::table('peminjaman')
                        ->join('users', 'peminjaman.user_id', '=', 'users.id')  // gabungkan dengan tabel users untuk ambil nama anggota
                        ->join('buku', 'peminjaman.buku_id', '=', 'buku.id') // gabungkan dengan tabel buku untuk ambil judul buku
                        ->select(
                            'peminjaman.id', // id peminjaman
                            'peminjaman.tanggal_pinjam', // tanggal pinjam
                            'peminjaman.jatuh_tempo', // batas pengembalian
                            'peminjaman.status', // status peminjaman
                            'users.name as nama_anggota',  // nama anggota
                            'buku.judul as judul_buku'  // judul buku
                        )
                         // urutkan dari yang terbaru
                        ->orderBy('peminjaman.created_at', 'desc')
                        ->limit(10) // batasi hanya 10 dat
                        ->get();
                        
         // kirim semua data ke view dashboard kepala
        return view('dashboard.kepala', compact(
            'totalBuku', 'totalAnggota', 'bukuDipinjam', 'terlambat', 'aktivitas'
        ));
    }
}