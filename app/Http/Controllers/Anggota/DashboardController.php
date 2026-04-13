<?php

namespace App\Http\Controllers\Anggota; // namespace untuk controller anggota

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung (query builder)

class DashboardController extends Controller
{
    public function index()
    {
        // ambil data peminjaman + gabungkan dengan tabel buku
        $peminjaman = DB::table('peminjaman')
            ->leftJoin('buku', 'peminjaman.buku_id', '=', 'buku.id')
            // ambil kolom dari buku + semua kolom peminjaman
            ->select('buku.judul', 'buku.pengarang', 'peminjaman.*')
            ->get(); // eksekusi query

        // hitung total semua data peminjaman
        $totalPinjam = DB::table('peminjaman')->count();

        // total denda (sementara belum dihitung, jadi 0)
        $totalDenda = 0;

        // kirim semua data ke view dashboard anggota
        return view('dashboard.anggota', compact(
            'peminjaman',
            'totalPinjam',
            'totalDenda'
        ));
    }
}