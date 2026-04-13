<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk kepala

use App\Http\Controllers\Controller; // controller utama Laravel
use App\Models\Kepala\Buku; // model Buku (khusus bagian kepala)
use App\Models\Kategori; // model Kategori

class DataBukuController extends Controller
{
    public function index()
    {
        // ambil semua data buku beserta relasi kategori (eager loading)
        // supaya tidak terjadi N+1 query
        $buku = Buku::with('kategori')->get();

        // ambil semua data kategori
        $kategori = Kategori::all();

        // kirim data buku dan kategori ke view
        return view('kepala.databuku.index', compact('buku', 'kategori'));
    }
}