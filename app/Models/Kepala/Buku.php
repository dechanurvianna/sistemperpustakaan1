<?php

namespace App\Models\Kepala;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'judul',
        'pengarang',
        'kategori_id',
        'tahun',
        'penerbit',
        'stok',
        'isbn',
        'gambar',
        'status'
    ];

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}