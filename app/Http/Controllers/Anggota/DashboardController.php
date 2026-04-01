<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = DB::table('peminjaman')
            ->join('buku', 'peminjaman.id_buku', '=', 'buku.id')
            ->select('buku.judul_buku', 'buku.pengarang', 'peminjaman.*')
            ->get();

        $totalPinjam = DB::table('peminjaman')
            ->where('status', 'dipinjam')
            ->count();

        $totalDenda = DB::table('pengembalian')->sum('jumlah_denda');

        return view('dashboard.anggota', compact(
            'peminjaman',
            'totalPinjam',
            'totalDenda'
        ));
    }
}
