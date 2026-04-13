@extends('layouts.backend.petugas.app')

@section('content')

<style>
.detail-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.detail-card {
    width: 700px;
    background: #f8f9fa;
    border-radius: 20px;
    padding: 30px;
    display: flex;
    gap: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.detail-img img {
    width: 180px;
    height: 260px;
    object-fit: cover;
    border-radius: 10px;
}

.detail-info {
    flex: 1;
}

.detail-info h3 {
    margin-bottom: 15px;
    font-weight: 600;
}

.label {
    font-weight: 500;
}

.badge-tersedia {
    background: #28a745;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
}

.btn-kembali {
    margin-top: 20px;
    background: #bfbfbf;
    border: none;
    padding: 6px 20px;
    border-radius: 20px;
    font-size: 12px;
}
</style>

<div class="detail-wrapper">
    <div class="detail-card">

        <!-- Gambar Buku -->
        <div class="detail-img">
            @if($buku->gambar)
                <img src="{{ asset('storage/' . $buku->gambar) }}" alt="cover">
            @else
                <div style="width: 180px; height: 260px; background: #e0e0e0; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #999;">
                    Tidak ada gambar
                </div>
            @endif
        </div>

        <!-- Detail Buku -->
        <div class="detail-info">
            <h3>{{ $buku->judul ?? '-' }}</h3>

            <p><span class="label">Pengarang :</span> {{ $buku->pengarang ?? '-' }}</p>
            <p><span class="label">Penerbit :</span> {{ $buku->penerbit ?? '-' }}</p>
            <p><span class="label">ISBN :</span> {{ $buku->isbn ?? '-' }}</p>
            <p><span class="label">Tahun Terbit :</span> {{ $buku->tahun_terbit ?? '-' }}</p>
            <p>
                <span class="label">Kategori :</span> 
                {{ $buku->kategori->nama_kategori ?? '-' }}
            </p>

            <p>
                <span class="label">Tersedia :</span>
                <span class="badge-tersedia">
                    ✔ {{ $buku->stok > 0 ? 'Tersedia' : 'Habis' }}
                </span>
            </p>

            <p><span class="label">Stok Buku :</span> {{ $buku->stok ?? 0 }}</p>

            <p>
                <span class="label">Deskripsi :</span><br>
                {{ $buku->deskripsi ?? '-' }}
            </p>

            <a href="{{ route('petugas.data-buku') }}" class="btn btn-kembali">Kembali</a>
        </div>

    </div>
</div>

@endsection