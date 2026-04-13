<?php

namespace App\Http\Controllers\Anggota; // namespace untuk controller anggota

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Http\Request; // untuk ambil data request dari form
use App\Models\Anggota\Buku; // model Buku (tabel buku)

class CariBukuController extends Controller
{
    public function cari(Request $request)
    {
        // ambil input keyword dari form pencarian
        $keyword = $request->keyword;

        // ambil data buku dengan kondisi pencarian
        $buku = Buku::when($keyword, function ($query) use ($keyword) {

            // jika keyword ada, cari berdasarkan:
            // judul ATAU pengarang ATAU isbn
            $query->where('judul', 'LIKE', "%$keyword%")
                  ->orWhere('pengarang', 'LIKE', "%$keyword%")
                  ->orWhere('isbn', 'LIKE', "%$keyword%");
        })
        ->get(); // eksekusi query dan ambil semua data

        // kirim data buku ke view pencarian
        return view('anggota.cari-buku', compact('buku'));
    }

    public function detail($id)
    {
        // ambil 1 data buku berdasarkan id
        // kalau tidak ada, otomatis error 404
        $buku = Buku::findOrFail($id);

        // kirim data ke halaman detail buku
        return view('anggota.detail-buku', compact('buku'));
    }
}