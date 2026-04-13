<?php

namespace App\Http\Controllers\Anggota; // namespace controller anggota

use App\Http\Controllers\Controller; // controller utama Laravel
use App\Models\Anggota\Buku; // model Buku
use Illuminate\Http\Request; // untuk handle request dari form
use Illuminate\Support\Facades\Auth; // untuk ambil user login
use Illuminate\Support\Facades\DB; // query database

class PeminjamanController extends Controller
{
    // ================= PINJAM =================
    public function create($id)
    {
        // ambil data buku berdasarkan id
        $buku = Buku::findOrFail($id);

        // tampilkan form peminjaman
        return view('anggota.peminjaman.create', compact('buku'));
    }

    public function store(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'buku_id' => 'required|exists:buku,id', // harus ada di tabel buku
            'tanggal_pinjam' => 'required|date|date_format:Y-m-d', // format tanggal
            'jatuh_tempo' => 'required|date|date_format:Y-m-d' // format tanggal
        ]);

        // ambil id user yang login
        $userId = Auth::id();

        // ambil id buku dari request
        $bukuId = $request->buku_id;

        // ambil data buku dari database
        $buku = DB::table('buku')->where('id', $bukuId)->first();

        // cek apakah buku tersedia
        if (!$buku || $buku->stok < 1 || $buku->status !== 'tersedia') {
            return back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Cegah peminjaman ganda (buku sedang diproses/dipinjam)
        $cek = DB::table('peminjaman')
            ->where('buku_id', $bukuId)
            ->whereIn('status', ['menunggu', 'dipinjam', 'menunggu_pengembalian'])
            ->exists();

        // kalau sudah ada yang pinjam/proses → tidak boleh pinjam lagi
        if ($cek) {
            return back()->with('error', 'Buku sedang dipinjam atau menunggu konfirmasi!');
        }

        // TRANSACTION biar aman (semua query dijalankan sekaligus)
        DB::transaction(function () use ($userId, $bukuId, $request) {

            // simpan data peminjaman
            DB::table('peminjaman')->insert([
                'user_id' => $userId,
                'buku_id' => $bukuId,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'jatuh_tempo' => $request->jatuh_tempo,
                'status' => 'menunggu', // status awal menunggu ACC petugas
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // stok tidak dikurangi di sini (menunggu konfirmasi petugas)
        });

        // redirect ke halaman list peminjaman
        return redirect()->route('anggota.peminjaman.index')
            ->with('success', 'Permintaan peminjaman berhasil dikirim. Menunggu konfirmasi petugas.');
    }

    // ================= LIST =================
    public function index()
    {
        // ambil data peminjaman milik user login
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->where('peminjaman.user_id', Auth::id()) // hanya milik user login
            ->whereIn('peminjaman.status', [
                'menunggu',
                'dipinjam',
                'menunggu_pengembalian',
                'selesai',
                'ditolak'
            ])
            ->select(
                'peminjaman.id',
                'users.name as name', // nama user
                'peminjaman.tanggal_pinjam',
                'peminjaman.jatuh_tempo',
                'peminjaman.status',
                'buku.judul as judul_buku' // judul buku
            )
            ->orderBy('peminjaman.created_at', 'desc') // urut terbaru
            ->limit(20) // batasi 20 data
            ->get();

        // kirim ke view
        return view('anggota.peminjaman.index', compact('data'));
    }

    // ================= FORM PENGEMBALIAN =================
    public function formPengembalian($id)
    {
        // ambil data peminjaman + relasi user & buku
        $data = DB::table('peminjaman')
            ->join('users', 'peminjaman.user_id', '=', 'users.id')
            ->join('buku', 'peminjaman.buku_id', '=', 'buku.id')
            ->select(
                'peminjaman.*',
                'users.name as name',
                'buku.judul as judul_buku'
            )
            ->where('peminjaman.id', $id)
            ->where('peminjaman.user_id', Auth::id()) // pastikan milik user login
            ->first();

        // kalau data tidak ditemukan
        if (!$data) {
            return redirect()->route('anggota.peminjaman.index')
                ->with('error', 'Data peminjaman tidak ditemukan.');
        }

        // tampilkan form pengembalian
        return view('anggota.pengembalian.create', compact('data'));
    }

    // ================= AJUKAN PENGEMBALIAN =================
    public function ajukanPengembalian(Request $request, $id)
    {
        // ambil data peminjaman
        $peminjaman = DB::table('peminjaman')->where('id', $id)->first();

        // cek data ada atau tidak
        if (!$peminjaman) {
            return back()->with('error', 'Data peminjaman tidak ditemukan');
        }

        // pastikan hanya pemilik yang bisa akses
        if ($peminjaman->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak');
        }

        // hanya bisa kembalikan jika status dipinjam
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Hanya buku yang sedang dipinjam yang bisa dikembalikan');
        }

        // validasi input tanggal pengembalian
        $request->validate([
            'tanggal_pengembalian' => 'required|date'
        ]);

        // ambil tanggal kembali
        $tanggalKembali = $request->tanggal_pengembalian;

        // parsing tanggal jatuh tempo & tanggal kembali pakai Carbon
        $jatuhTempo = \Carbon\Carbon::parse($peminjaman->jatuh_tempo);
        $tanggalKembaliCarbon = \Carbon\Carbon::parse($tanggalKembali);

        // default denda = 0
        $denda = 0;

        // jika terlambat → hitung denda (hari × 1000)
        if ($tanggalKembaliCarbon->gt($jatuhTempo)) {
            $denda = $jatuhTempo->diffInDays($tanggalKembaliCarbon) * 1000;
        }

        try {
            DB::transaction(function () use ($id, $tanggalKembali, $denda) {

                // simpan data pengembalian
                DB::table('pengembalian')->insert([
                    'peminjaman_id' => $id,
                    'tanggal_kembali' => $tanggalKembali,
                    'denda' => $denda,
                    'status' => 'menunggu', // menunggu konfirmasi petugas
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // update status peminjaman
                DB::table('peminjaman')
                    ->where('id', $id)
                    ->update([
                        'status' => 'menunggu_pengembalian',
                        'updated_at' => now()
                    ]);

                // stok belum ditambah (menunggu ACC petugas)
            });
        } catch (\Exception $e) {
            // jika gagal
            return back()->with('error', 'Gagal mengajukan pengembalian. Silakan coba lagi.');
        }

        // redirect setelah berhasil
        return redirect()->route('anggota.peminjaman.index')
            ->with('success', 'Permintaan pengembalian berhasil dikirim. Menunggu konfirmasi petugas.');
    }

    public function show($id)
    {
        // redirect ke index (tidak digunakan)
        return redirect()->route('anggota.peminjaman.index');
    }
}