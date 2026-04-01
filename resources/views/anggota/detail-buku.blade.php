@extends('layouts.backend.app')

@section('content')

<style>
.detail-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.detail-card {
    width: 600px; /* 🔥 biar nggak kepanjangan */
    border-radius: 20px;
    background: #fff;
    padding: 25px;
}

.book-img {
    width: 150px;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
}

.badge-status {
    border-radius: 20px;
    padding: 5px 12px;
    font-size: 12px;
}

.btn-kembali {
    border-radius: 20px;
    font-size: 12px;
    padding: 5px 15px;
}
</style>

<div class="detail-wrapper">

    <div class="detail-card shadow-sm">

        <div class="d-flex align-items-center">

            <!-- GAMBAR -->
            <img src="{{ $buku->gambar ?? 'https://via.placeholder.com/150x220' }}" class="book-img me-4">

            <!-- DETAIL -->
            <div>

                <h5 class="fw-bold">{{ $buku->judul }}</h5>

                <p class="mb-1"><strong>Pengarang :</strong> {{ $buku->pengarang }}</p>
                <p class="mb-1"><strong>Kategori :</strong> {{ $buku->kategori ?? 'Novel' }}</p>
                <p class="mb-1"><strong>Tahun Terbit :</strong> {{ $buku->tahun_terbit ?? '-' }}</p>

                <p class="mb-2">
                    <strong>Tersedia :</strong>
                    @if($buku->status == 'tersedia')
                        <span class="badge bg-success badge-status">✔ Tersedia</span>
                    @else
                        <span class="badge bg-danger badge-status">Dipinjam</span>
                    @endif
                </p>

                <p style="font-size: 14px;">
                    <strong>Sinopsis :</strong><br>
                    {{ $buku->deskripsi ?? 'Tidak ada sinopsis' }}
                </p>

                <div class="text-end mt-3">
                    <a href="{{ route('cari.buku') }}" class="btn btn-secondary btn-kembali">
                        Kembali
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
