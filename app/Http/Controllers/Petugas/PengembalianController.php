<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class PengembalianController extends Controller
{
    // ================= LIST =================
    public function index()
    {
        $data = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select(
                'pengembalian.id',
                'users.name as nama_user',
                'buku.judul as judul_buku',
                'peminjaman.tanggal_pinjam',
                'peminjaman.jatuh_tempo',
                'pengembalian.tanggal_kembali as tanggal_pengembalian',
                'pengembalian.denda as jumlah_denda',
                'pengembalian.status'
            )
            ->where('pengembalian.status', 'menunggu')
            ->orderBy('pengembalian.created_at', 'desc')
            ->get();

        return view('petugas.pengembalian.index', compact('data'));
    }

    // ================= KONFIRMASI =================
    public function konfirmasi($id)
    {
        $pengembalian = DB::table('pengembalian')->where('id', $id)->first();

        if (!$pengembalian) {
            return back()->with('error', 'Data pengembalian tidak ditemukan');
        }

        if ($pengembalian->status !== 'menunggu') {
            return back()->with('error', 'Pengembalian ini sudah dikonfirmasi');
        }

        // Ambil data peminjaman
        $peminjaman = DB::table('peminjaman')->where('id', $pengembalian->peminjaman_id)->first();

        $buku = DB::table('buku')->where('id', $peminjaman->buku_id)->first();

        DB::transaction(function () use ($id, $pengembalian, $peminjaman) {
            // Update status pengembalian menjadi selesai
            DB::table('pengembalian')
                ->where('id', $id)
                ->update([
                    'status' => 'selesai',
                    'updated_at' => now()
                ]);

            // Update status peminjaman menjadi selesai
            DB::table('peminjaman')
                ->where('id', $peminjaman->id)
                ->update([
                    'status' => 'selesai',
                    'tanggal_pengembalian' => $pengembalian->tanggal_kembali,
                    'updated_at' => now()
                ]);

            // Update status buku kembali menjadi tersedia
            DB::table('buku')
                ->where('id', $peminjaman->buku_id)
                ->update([
                    'status' => 'tersedia',
                    'stok' => DB::raw('stok + 1'),
                    'updated_at' => now()
                ]);
        });

        return back()->with('success', 'Pengembalian dikonfirmasi. Buku kembali tersedia.');
    }
}