<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
     protected $table = 'peminjaman';

    protected $fillable = [
        'nama',
        'judul_buku',
        'tanggal_peminjaman',
        'jatuh_tempo',
        'tanggal_pengembalian',
        'status',
        'aksi',
    ];
}
