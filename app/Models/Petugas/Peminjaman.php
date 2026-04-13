<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Anggota\Buku; // tetap ini, bukan Petugas\Buku

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'buku_id',
        'petugas_id',
        'tanggal_peminjaman',
        'jatuh_tempo',
        'tanggal_pengembalian',
        'status',
        'denda',
    ];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function buku() { return $this->belongsTo(Buku::class, 'buku_id'); }
    public function petugas() { return $this->belongsTo(User::class, 'petugas_id'); }
}