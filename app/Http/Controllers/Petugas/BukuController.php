<?php

namespace App\Http\Controllers\Petugas; // namespace controller untuk petugas

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Http\Request; // untuk handle request dari form
use App\Models\Petugas\Buku; // model Buku khusus petugas

class BukuController extends Controller
{
    // ================= FORM TAMBAH =================
    public function create()
    {
        // menampilkan halaman form tambah buku
        return view('petugas.buku.create');
    }

    // ================= SIMPAN DATA =================
    public function store(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'judul' => 'required', // judul wajib diisi
            'pengarang' => 'required', // pengarang wajib
            'penerbit' => 'required', // penerbit wajib
            'tahun' => 'required|numeric', // tahun harus angka
            'kategori_id' => 'required', // harus pilih kategori
            'stok' => 'required|numeric', // stok harus angka
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048' // cover opsional, harus gambar max 2MB
        ]);

        // ambil data dari request
        $data = $request->only([
            'judul',
            'pengarang',
            'penerbit',
            'tahun',
            'kategori_id',
            'stok'
        ]);

        // ================= UPLOAD COVER =================
        if ($request->hasFile('cover')) {
            $file = $request->file('cover'); // ambil file
            $namaFile = time() . '.' . $file->extension(); // buat nama file unik
            $file->move(public_path('cover'), $namaFile); // simpan ke folder public/cover
            $data['cover'] = $namaFile; // simpan nama file ke database
        }

        // simpan data buku ke database
        Buku::create($data);

        // kembali ke halaman sebelumnya + pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    // ================= FORM EDIT =================
    public function edit($id)
    {
        // ambil data buku berdasarkan id
        $buku = Buku::findOrFail($id);

        // convert ke object (biar pasti bisa dipakai di view)
        $buku = (object) $buku;

        // kirim ke halaman edit
        return view('petugas.buku.edit', compact('buku'));
    }

    // ================= UPDATE DATA =================
    public function update(Request $request, $id)
    {
        // ambil data buku
        $buku = Buku::findOrFail($id);

        // validasi input
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'kategori_id' => 'required',
            'stok' => 'required|numeric',
            'cover' => 'nullable|image' // cover opsional
        ]);

        // ambil data dari request
        $data = $request->only([
            'judul',
            'pengarang',
            'penerbit',
            'tahun',
            'kategori_id',
            'stok'
        ]);

        // ================= UPLOAD COVER BARU =================
        if ($request->hasFile('cover')) {
            $file = $request->file('cover'); // ambil file baru
            $namaFile = time() . '.' . $file->extension(); // nama unik
            $file->move(public_path('cover'), $namaFile); // simpan file
            $data['cover'] = $namaFile; // update nama file di database
        }

        // update data buku
        $buku->update($data);

        // redirect ke halaman index buku + pesan sukses
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diupdate');
    }
}