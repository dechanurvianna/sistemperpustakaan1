<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota\Buku; // ✅ tambahkan ini

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
    ];

    // Relasi ke buku
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    // Relasi ke user (anggota)
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}