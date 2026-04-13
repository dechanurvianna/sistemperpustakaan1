<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk kepala

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung

class PeminjamanController extends Controller
{
    // ================= LIST SEMUA PEMINJAMAN (READ-ONLY) =================
    public function index()
    {
        // ambil semua data peminjaman + gabungkan dengan user & buku
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id') // ambil nama peminjam
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id') // ambil judul buku
            ->select(
                'peminjaman.id', // id peminjaman
                'users.name as peminjam', // nama peminjam
                'buku.judul as judul_buku', // judul buku
                'peminjaman.tanggal_pinjam', // tanggal pinjam
                'peminjaman.jatuh_tempo', // batas pengembalian
                'peminjaman.status' // status peminjaman
            )
            // urutkan dari data terbaru
            ->orderBy('peminjaman.created_at', 'desc')
            ->paginate(15); // tampilkan 15 data per halaman (pagination)

        // kirim data ke view
        return view('kepala.peminjaman.index', compact('data'));
    }

    // ================= DETAIL PEMINJAMAN (READ-ONLY) =================
    public function show($id)
    {
        // ambil detail 1 data peminjaman berdasarkan id
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id') // ambil nama peminjam
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id') // ambil judul buku
            ->select(
                'peminjaman.*', // semua kolom peminjaman
                'users.name as peminjam', // nama peminjam
                'buku.judul as judul_buku' // judul buku
            )
            ->where('peminjaman.id', $id) // filter berdasarkan id
            ->first(); // ambil 1 data

        // jika data tidak ditemukan
        if (!$data) {
            return back()->with('error', 'Data peminjaman tidak ditemukan');
        }

        // tampilkan ke halaman detail
        return view('kepala.peminjaman.show', compact('data'));
    }
}