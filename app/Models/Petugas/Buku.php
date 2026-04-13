<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Petugas\Peminjaman;
use App\Models\Kategori;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun',
        'kategori_id',
        'stok',
        'deskripsi',
        'gambar'
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // 🔥 Relasi ke kategori (WAJIB)
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}