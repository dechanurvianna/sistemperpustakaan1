<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk kepala

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Http\Request; // untuk mengambil input dari request (URL / form)
use Illuminate\Support\Facades\DB; // query database

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {
        // ambil parameter dari URL (GET)
        $jenis = $request->query('jenis_laporan'); // jenis laporan (peminjaman / pengembalian)
        $mulai = $request->query('tanggal_mulai'); // tanggal mulai
        $selesai = $request->query('tanggal_selesai'); // tanggal selesai

        // default data kosong
        $data = collect();

        // cek apakah semua input ada dan tanggal valid (mulai <= selesai)
        if ($jenis && $mulai && $selesai && $mulai <= $selesai) {

            // ================= LAPORAN PEMINJAMAN =================
            if ($jenis === 'peminjaman') {
                $data = DB::table('peminjaman')
                    // gabung ke tabel users untuk ambil nama anggota
                    ->join('users', 'peminjaman.user_id', '=', 'users.id')
                    // gabung ke tabel buku untuk ambil judul buku
                    ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                    ->select(
                        'users.name as nama_anggota', // nama anggota
                        'buku.judul as judul_buku', // judul buku
                        'peminjaman.tanggal_pinjam', // tanggal pinjam
                        'peminjaman.jatuh_tempo', // batas pengembalian
                        'peminjaman.tanggal_pengembalian', // tanggal kembali (jika ada)
                        'peminjaman.status' // status peminjaman
                    )
                    // filter berdasarkan rentang tanggal pinjam
                    ->whereBetween('peminjaman.tanggal_pinjam', [$mulai, $selesai])
                    // urutkan dari yang terbaru
                    ->orderBy('peminjaman.tanggal_pinjam', 'desc')
                    ->get();
            } 

            // ================= LAPORAN PENGEMBALIAN =================
            elseif ($jenis === 'pengembalian') {
                $data = DB::table('pengembalian')
                    // gabung ke tabel peminjaman
                    ->join('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
                    // gabung ke tabel users
                    ->join('users', 'peminjaman.user_id', '=', 'users.id')
                    // gabung ke tabel buku
                    ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
                    ->select(
                        'users.name as nama_anggota', // nama anggota
                        'buku.judul as judul_buku', // judul buku
                        'peminjaman.tanggal_pinjam', // tanggal pinjam
                        'peminjaman.jatuh_tempo', // jatuh tempo
                        'pengembalian.tanggal_kembali', // tanggal dikembalikan
                        'pengembalian.status' // status pengembalian
                    )
                    // filter berdasarkan tanggal pengembalian
                    ->whereBetween('pengembalian.tanggal_kembali', [$mulai, $selesai])
                    // urutkan dari yang terbaru
                    ->orderBy('pengembalian.tanggal_kembali', 'desc')
                    ->get();
            }
        }

        // kirim data ke view laporan
        return view('kepala.laporan', compact('data', 'jenis', 'mulai', 'selesai'));
    }
}