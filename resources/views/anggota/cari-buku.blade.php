@extends('layouts.backend.app')

@section('content')

<style>
.search-box input {
    border-radius: 20px;
    padding: 10px 15px;
}
.search-box button {
    border-radius: 10px;
    padding: 8px 20px;
}
.filter-btn {
    border-radius: 15px;
    font-size: 14px;
}
.book-card {
    border-radius: 15px;
    transition: 0.3s;
    background: #fff;
}
.book-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.book-img {
    width: 70px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
}
.btn-sm {
    border-radius: 20px;
    font-size: 12px;
    padding: 4px 12px;
}
.badge {
    border-radius: 20px;
    padding: 5px 10px;
}
</style>

<div class="container-fluid">

    <!-- SEARCH -->
    <form method="GET" action="/cari-buku" class="d-flex mb-3 search-box">
        <input type="text" name="keyword" class="form-control me-2"
               placeholder="Cari Judul, Pengarang"
               value="{{ request('keyword') }}">
        <button class="btn btn-info text-white">Cari</button>
    </form>

    <!-- LIST BUKU -->
    <div class="row">

        @forelse($buku as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="book-card p-3 shadow-sm">
                <div class="d-flex align-items-center">

                    <!-- GAMBAR -->
                    <img src="{{ $item->gambar ?? 'https://via.placeholder.com/70x100' }}" class="book-img me-3">

                    <!-- INFO -->
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->pengarang }}</small>

                        <div class="mt-2 d-flex align-items-center">

                            @if($item->status == 'tersedia')
                                <span class="badge bg-success">Tersedia</span>

                                <!-- ✅ PINJAM (SUDAH BENAR) -->
                                <a href="{{ route('peminjaman.create', $item->id) }}"
                                   class="btn btn-primary btn-sm ms-2">
                                   Pinjam
                                </a>

                            @else
                                <span class="badge bg-danger">Dipinjam</span>
                            @endif

                            <!-- DETAIL -->
                            <a href="{{ route('buku.detail', $item->id) }}"
                               class="btn btn-secondary btn-sm ms-2">
                                Detail
                            </a>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        @empty
            <div class="text-center">
                <p>Tidak ada buku ditemukan</p>
            </div>
        @endforelse

    </div>

</div>

@endsection
