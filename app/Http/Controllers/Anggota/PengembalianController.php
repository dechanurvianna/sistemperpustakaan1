<?php

namespace App\Http\Controllers\Anggota; // namespace controller anggota

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung

class PengembalianController extends Controller
{
    // ✅ untuk halaman riwayat pengembalian (anggota)
    public function index()
    {
        try {
            // ambil data pengembalian + gabungkan dengan tabel peminjaman, buku, dan user
            $data = DB::table('pengembalian')
                ->leftJoin('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
                ->leftJoin('buku', 'peminjaman.buku_id', '=', 'buku.id')
                ->leftJoin('users', 'peminjaman.user_id', '=', 'users.id')
                ->select(
                    'pengembalian.status as status_pengembalian', // status pengembalian
                    'users.name', // nama user
                    'buku.judul as judul_buku', // judul buku
                    'peminjaman.tanggal_pinjam', // tanggal pinjam
                    'peminjaman.jatuh_tempo', // batas pengembalian
                    'pengembalian.tanggal_kembali', // tanggal dikembalikan
                    'pengembalian.denda' // jumlah denda
                )
                // hanya tampilkan data milik user yang sedang login
                ->where('peminjaman.user_id', auth()->id())
                // urutkan dari yang terbaru
                ->orderBy('pengembalian.created_at', 'desc')
                ->get(); // ambil semua data
        } catch (\Exception $e) {
            // jika terjadi error (misalnya tabel belum ada / query gagal)
            $data = collect(); // set data jadi kosong agar tidak error di view
        }

        // kirim data ke halaman riwayat pengembalian
        return view('anggota.pengembalian.index', compact('data'));
    }
}