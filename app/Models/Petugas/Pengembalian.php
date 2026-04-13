<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';

    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'jumlah_denda',
        'status'
    ];

    // relasi ke peminjaman (optional tapi bagus)
    public function peminjaman()
    {
        return $this->belongsTo(\App\Models\Anggota\Peminjaman::class, 'peminjaman_id');
    }
}