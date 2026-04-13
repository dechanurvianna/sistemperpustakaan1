<?php

namespace App\Models\Kepala;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Kepala\Buku;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    // Field yang bisa diisi massal
    protected $fillable = [
        'user_id',       // id anggota
        'buku_id',       // id buku
        'petugas_id',    // id petugas (opsional, kalau ada)
        'status',        // dipinjam / selesai / menunggu
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    // Agar bisa pakai $peminjaman->tanggal_pinjam->format('d-m-Y')
    protected $dates = ['tanggal_pinjam', 'tanggal_kembali'];

    // RELASI ke anggota
    public function anggota()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    // RELASI ke petugas (kalau ada kolom petugas_id)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // LABEL STATUS untuk tampilan Blade
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'dipinjam' => 'Dipinjam',
            'selesai', 'dikembalikan' => 'Dikembalikan',
            'menunggu' => 'Menunggu',
            default => ucfirst($this->status),
        };
    }

    // CEK apakah buku terlambat dikembalikan
    public function getTerlambatAttribute()
    {
        return $this->status === 'dipinjam' && $this->tanggal_kembali < Carbon::today();
    }
}