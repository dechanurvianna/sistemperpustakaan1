<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota\Buku;

class CariBukuController extends Controller
{
    // Method untuk cari buku
    public function cari(Request $request)
    {
        $keyword = $request->keyword;

        if ($keyword) {
            $buku = Buku::where(function ($query) use ($keyword) {
                $query->where('judul', 'LIKE', "%$keyword%")
                      ->orWhere('pengarang', 'LIKE', "%$keyword%")
                      ->orWhere('isbn', 'LIKE', "%$keyword%");
            })->get();
        } else {
            // Tampilkan semua buku jika belum search
            $buku = Buku::all();
        }

        return view('anggota.cari-buku', compact('buku'));
    }

    // Method untuk detail buku
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('anggota.detail-buku', compact('buku'));
    }
}
