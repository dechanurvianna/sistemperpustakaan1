<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk kepala

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung

class PengembalianController extends Controller
{
    // ================= LIST SEMUA PENGEMBALIAN (READ-ONLY) =================
    public function index()
    {
        // ambil semua data pengembalian + gabungkan dengan peminjaman, user, dan buku
        $data = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id') // relasi ke peminjaman
            ->join('users', 'peminjaman.user_id', '=', 'users.id') // ambil nama user
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id') // ambil judul buku
            ->select(
                'pengembalian.id', // id pengembalian
                'users.name as nama_user', // nama user
                'buku.judul as judul_buku', // judul buku
                'peminjaman.tanggal_pinjam', // tanggal pinjam
                'peminjaman.jatuh_tempo', // batas pengembalian
                'pengembalian.tanggal_kembali as tanggal_pengembalian', // tanggal dikembalikan
                'pengembalian.denda as jumlah_denda', // jumlah denda
                'pengembalian.status' // status pengembalian
            )
            // urutkan dari data terbaru
            ->orderBy('pengembalian.created_at', 'desc')
            ->paginate(15); // pagination 15 data per halaman

        // kirim data ke view
        return view('kepala.pengembalian.index', compact('data'));
    }

    // ================= DETAIL PENGEMBALIAN (READ-ONLY) =================
    public function show($id)
    {
        // ambil detail 1 data pengembalian berdasarkan id
        $data = DB::table('pengembalian')
            ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id') // relasi ke peminjaman
            ->join('users', 'peminjaman.user_id', '=', 'users.id') // ambil nama user
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id') // ambil judul buku
            ->select(
                'pengembalian.*', // semua kolom pengembalian
                'users.name as nama_user', // nama user
                'buku.judul as judul_buku', // judul buku
                'peminjaman.tanggal_pinjam', // tanggal pinjam
                'peminjaman.jatuh_tempo' // jatuh tempo
            )
            ->where('pengembalian.id', $id) // filter berdasarkan id
            ->first(); // ambil 1 data

        // jika data tidak ditemukan
        if (!$data) {
            return back()->with('error', 'Data pengembalian tidak ditemukan');
        }

        // tampilkan ke halaman detail
        return view('kepala.pengembalian.show', compact('data'));
    }
}