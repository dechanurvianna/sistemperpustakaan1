<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota\Buku;
use App\Models\Anggota\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔒 Cek login & role
        if (!session('user_id') || session('role') != 'petugas') {
            return redirect('/login');
        }

        // 📊 Total data
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalBuku = Buku::count();
        $totalDenda = Peminjaman::sum('denda');

        // 📚 Peminjaman terbaru + relasi (biar cepat)
        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->latest()
            ->take(5)
            ->get();

        return view('petugas.dashboard', compact(
            'totalAnggota',
            'totalBuku',
            'totalDenda',
            'peminjaman'
        ));
    }
}
