<?php

namespace App\Models\Petugas;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Peminjaman extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function buku()
{
    return $this->belongsTo(Buku::class);
}
}
