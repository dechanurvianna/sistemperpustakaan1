<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Anggota\Buku;
use App\Models\Anggota\Peminjaman;

class PeminjamanController extends Controller
{
    // ✅ FORM PEMINJAMAN
    public function create($id)
    {
        $buku = Buku::findOrFail($id);

        return view('peminjamananggota.create', compact('buku'));
    }

    // ✅ SIMPAN DATA
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'judul_buku' => 'required',
            'tanggal_peminjaman' => 'required',
            'jatuh_tempo' => 'required',
        ]);

        DB::table('peminjaman')->insert([
            'nama' => $request->nama,
            'judul_buku' => $request->judul_buku,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'jatuh_tempo' => $request->jatuh_tempo,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status' => 'dipinjam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('cari.buku')
            ->with('success', 'Data berhasil disimpan!');
    }

    // ✅ TAMPILKAN DATA
    public function index()
    {
        $data = DB::table('peminjaman')->latest()->get();

        return view('peminjamananggota.index', compact('data'));
    }

    // ✅ DETAIL PEMINJAMAN
    public function show($id)
    {
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();

        if (!$peminjaman) {
            abort(404);
        }

        return view('peminjamananggota.detail', compact('peminjaman'));
    }

    // ✅ HAPUS DATA (INI YANG DITAMBAH 🔥)
   public function destroy($id)
    {
    $data = Peminjaman::findOrFail($id);
    $data->delete();

    return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function formPengembalian($id)
{
    $data = DB::table('peminjaman')->where('id', $id)->first();

    return view('pengembaliananggota.pengembalian', compact('data'));
}
}
