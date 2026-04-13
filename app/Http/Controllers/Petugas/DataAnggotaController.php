<?php

namespace App\Http\Controllers\Petugas; // namespace controller untuk petugas

use App\Http\Controllers\Controller; // controller utama Laravel
use Illuminate\Support\Facades\DB; // untuk query database langsung

class DataAnggotaController extends Controller
{
    public function index()
    {
        // ambil semua data user yang memiliki role 'anggota'
        $anggota = DB::table('users')
            ->where('role', 'anggota') // filter hanya anggota
            ->get(); // ambil semua data

        // kirim data anggota ke view
        return view('petugas.dataanggota.index', compact('anggota'));
    }

    public function destroy($id)
    {
        // hapus data user berdasarkan id
        DB::table('users')->where('id', $id)->delete();

        // kembali ke halaman sebelumnya + pesan sukses
        return redirect()->back()->with('success', 'Data anggota berhasil dihapus');
    }
}