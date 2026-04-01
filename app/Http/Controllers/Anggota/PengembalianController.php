<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    // ✅ untuk halaman riwayat pengembalian (anggota)
    public function index()
    {
        $data = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->select(
                'peminjaman.nama',
                'peminjaman.judul_buku',
                'peminjaman.tanggal_peminjaman',
                'peminjaman.jatuh_tempo',
                'pengembalian.tanggal_pengembalian',
                'pengembalian.keterlambatan',
                'pengembalian.denda'
            )
            ->get();

        return view('pengembaliananggota.index', compact('data'));
    }
}
