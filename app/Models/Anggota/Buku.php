<?php

namespace App\Models\Anggota;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'isbn',
        'gambar',
        'status'
    ];
}
