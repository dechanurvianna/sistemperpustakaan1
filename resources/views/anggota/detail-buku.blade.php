@extends('layouts.backend.anggota.app')

@section('content')

<style>
.detail-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.detail-card {
    width: 650px;
    border-radius: 20px;
    background: #fff;
    padding: 30px;
}

.book-img {
    width: 150px;
    height: 220px;
    object-fit: cover;
    border-radius: 12px;
}

.detail-card strong {
    color: #333;
    min-width: 120px;
    display: inline-block;
}
</style>

<div class="d-flex justify-content-center mt-5">

    <div class="detail-card shadow-sm">

        <div class="d-flex gap-4 align-items-start">

            <!-- GAMBAR -->
            <img src="{{ asset('storage/' . $buku->gambar) }}" class="book-img">

            <!-- DETAIL -->
            <div class="flex-grow-1">

                <h5 class="fw-bold mb-3">{{ $buku->judul }}</h5>

                <div class="mb-2"><strong>Pengarang :</strong> {{ $buku->pengarang }}</div>
                <div class="mb-2"><strong>Penerbit :</strong> {{ $buku->penerbit ?? '-' }}</div>
                <div class="mb-2"><strong>Kategori :</strong> {{ $buku->kategori->nama_kategori ?? '-' }}</div>
                <div class="mb-2"><strong>Tahun Terbit :</strong> {{ $buku->tahun_terbit ?? '-' }}</div>

                <div class="mb-2">
                    <strong>Stok :</strong>
                    @if($buku->stok > 0)
                        <span class="badge bg-success">{{ $buku->stok }}</span>
                    @else
                        <span class="badge bg-danger">Habis</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Status :</strong>
                    @if($buku->status == 'tersedia')
                        <span class="badge bg-success badge-status">✔ Tersedia</span>
                    @else
                        <span class="badge bg-danger badge-status">Dipinjam</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Deskripsi :</strong>
                    <p class="mt-1 text-muted" style="font-size: 14px; line-height: 1.5;">
                        {{ $buku->deskripsi ?? '-' }}
                    </p>
                </div>

                <div class="text-end">
                    <a href="{{ route('anggota.cari-buku') }}" class="btn btn-secondary btn-kembali">
                        Kembali
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
