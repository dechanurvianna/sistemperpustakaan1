@extends('layouts.backend.anggota.app')

@section('content')

<div class="container-fluid">

    <!-- SEARCH -->
    <form method="GET" action="{{ route('anggota.cari-buku') }}" class="d-flex mb-4">
        <input type="text" name="keyword" class="form-control me-2"
               placeholder="Cari Judul, Pengarang"
               value="{{ $keyword ?? '' }}">
        <button class="btn btn-info text-white">Cari</button>
    </form>

    <!-- LIST BUKU -->
    <div class="row">

        @forelse($buku as $item)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="p-3 shadow-sm bg-white rounded">

                <div class="d-flex align-items-center">

                    <!-- GAMBAR -->
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/70x100' }}"
                         style="width:70px; height:100px; object-fit:cover; border-radius:8px;"
                         class="me-3">

                    <!-- INFO -->
                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-bold">{{ $item->judul }}</h6>
                        <small class="text-muted">{{ $item->pengarang }}</small>
                        <small class="text-muted d-block">Stok: {{ $item->stok }}</small>

                        <div class="mt-2">

                            @if($item->status == 'tersedia')
                                <span class="badge bg-success">Tersedia</span>

                                <a href="{{ route('anggota.peminjaman.create', $item->id) }}"
                                   class="btn btn-primary btn-sm ms-2">
                                   Pinjam
                                </a>
                            @else
                                <span class="badge bg-danger">Dipinjam</span>
                            @endif

                            <a href="{{ route('anggota.buku.detail', $item->id) }}"
                               class="btn btn-secondary btn-sm ms-2">
                                Detail
                            </a>

                        </div>
                    </div>

                </div>

            </div>
        </div>
        @empty
            <div class="text-center mt-5">
                <h5>Buku tidak ditemukan 😢</h5>
                <p>Coba cari dengan kata kunci lain</p>
            </div>
        @endforelse

    </div>

</div>

@endsection
