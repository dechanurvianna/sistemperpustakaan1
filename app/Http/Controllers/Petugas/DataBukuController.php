<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Petugas\Buku;
use App\Models\Kategori;


class DataBukuController extends Controller
{
    // TAMPIL DATA BUKU
    public function index()
    {
        // Pakai Eloquent supaya Blade bisa akses properti stok langsung
        $buku = Buku::all();
        return view('petugas.data-buku', compact('buku'));
    }

    // FORM TAMBAH BUKU
    public function create()
    {
        $kategori = Kategori::all();  //Ambil data kategori
        return view('petugas.create', compact('kategori'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'isbn' => $request->isbn ?? null,
            'gambar' => $request->gambar ?? null,
            'status' => 'tersedia', // default
            'stok' => $request->stok ?? 0,
            'deskripsi' => $request->deskripsi ?? null,
            'penerbit' => $request->penerbit ?? null,
            'kategori_id' => $request->kategori_id,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        return redirect()->route('petugas.data-buku');
    }

    // FORM EDIT
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();

         return view('petugas.edit', compact('buku', 'kategori'));
    }

    // 🔄 UPDATE
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);
        $buku->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'isbn' => $request->isbn,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'penerbit' => $request->penerbit,
            'kategori_id' => $request->kategori_id,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        return redirect()->route('petugas.data-buku');
    }

    // DELETE
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect()->route('petugas.data-buku');
    }

    // 🔎 DETAIL BUKU
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('petugas.detail', compact('buku'));
    }
}
