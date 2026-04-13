<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    // 🔥 Tampil semua data peminjaman
    public function index()
    {
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select(
                'peminjaman.*',
                'users.name as peminjam',
                'buku.judul as judul_buku'
            )
            ->orderBy('peminjaman.created_at', 'desc')
            ->get();

        return view('petugas.peminjaman.index', compact('data'));
    }

    // ✅ ACC peminjaman dan update status buku menjadi dipinjam
    public function acc($id)
    {
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();

        if (!$peminjaman) {
            return back()->with('error', 'Data peminjaman tidak ditemukan');
        }

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Hanya peminjaman menunggu yang bisa dikonfirmasi');
        }

        $buku = DB::table('buku')->where('id', $peminjaman->buku_id)->first();
        if (!$buku || $buku->stok < 1) {
            return back()->with('error', 'Stok buku sudah habis.');
        }

        DB::transaction(function () use ($id, $peminjaman) {
            // Update status peminjaman menjadi dipinjam
            DB::table('peminjaman')
                ->where('id', $id)
                ->update([
                    'status' => 'dipinjam',
                    'updated_at' => now()
                ]);

            // Update status buku menjadi dipinjam
            DB::table('buku')
                ->where('id', $peminjaman->buku_id)
                ->update([
                    'status' => 'dipinjam',
                    'stok' => DB::raw('stok - 1'),
                    'updated_at' => now()
                ]);
        });

        return back()->with('success', 'Peminjaman dikonfirmasi. Buku sedang dipinjam.');
    }

    // ❌ Tolak peminjaman
    public function tolak($id)
    {
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();

        if (!$peminjaman) {
            return back()->with('error', 'Data peminjaman tidak ditemukan');
        }

        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Hanya peminjaman menunggu yang bisa ditolak');
        }

        // Update status peminjaman menjadi ditolak
        DB::table('peminjaman')
            ->where('id', $id)
            ->update([
                'status' => 'ditolak',
                'updated_at' => now()
            ]);

        return back()->with('success', 'Peminjaman ditolak');
    }
}
