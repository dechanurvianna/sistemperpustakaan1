@extends('layouts.backend.petugas.app')

@section('content')

<style>
/* Container utama */
.container-dashboard {
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    min-height: 100vh;
}

/* HEADER */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.search-box {
    display: flex;
    width: 300px;
}

.search-box input {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 5px 0 0 5px;
    outline: none;
}

.search-box button.btn-search {
    padding: 8px 12px;
    background-color: #1d4ed8;
    color: white;
    border: none;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* BUTTON TAMBAH */
.action {
    margin-bottom: 20px;
}

.btn-add {
    padding: 10px 20px;
    background-color: #10b981;
    color: white;
    border-radius: 5px;
    text-decoration: none;
}

/* LIST */
.book-list {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

/* CARD */
.card-book {
    background-color: white;
    border-radius: 12px;
    padding: 12px;
    display: flex;
    gap: 12px;
    width: 100%;
    max-width: 350px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: 0.2s;
}

.card-book:hover {
    transform: scale(1.02);
}

.card-book img {
    width: 80px;
    height: 110px;
    object-fit: cover;
    border-radius: 8px;
}

.info h5 {
    margin: 0;
}

.info p {
    margin: 0;
    font-size: 14px;
    color: #6b7280;
}

/* STATUS */
.status {
    margin-top: 5px;
}

.badge {
    padding: 4px 8px;
    border-radius: 5px;
    font-size: 12px;
}

.bg-success {
    background: #10b981;
    color: white;
}

.bg-danger {
    background: #ef4444;
    color: white;
}

/* BUTTON */
.btn-group {
    margin-top: 8px;
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 4px 8px;
    font-size: 12px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.btn-detail { background: #6b7280; color: white; }
.btn-edit { background: #3b82f6; color: white; }
.btn-delete { background: #ef4444; color: white; }

/* RESPONSIVE */
@media (min-width: 768px) {
    .card-book {
        width: calc(50% - 20px);
    }
}

@media (min-width: 1200px) {
    .card-book {
        width: calc(33.33% - 20px);
    }
}
</style>

<div class="container-dashboard">

    <!-- HEADER -->
    <div class="header">
        <form action="" method="GET" class="search-box">
            <input type="text" name="keyword" placeholder="Cari Judul, atau Pengarang">
            <button class="btn-search">Cari</button>
        </form>

        <div class="user-info">
            
        </div>
    </div>

    <!-- BUTTON TAMBAH -->
    <div class="action">
        <a href="{{ route('petugas.buku.create') }}" class="btn-add">+ Tambah Buku</a>
    </div>

    <!-- LIST BUKU -->
    <div class="book-list">

        @foreach($buku as $item)
        <div class="card-book">

            <!-- COVER -->
            <img src="{{ asset('storage/' . $item->gambar) }}">

            <!-- INFO -->
            <div class="info">
                <h5>{{ $item->judul }}</h5>
                <p>{{ $item->pengarang }}</p>

                <!-- STATUS -->
                <div class="status">
                    @if($item->stok > 0)
                        <span class="badge bg-success">Tersedia</span>
                    @else
                        <span class="badge bg-danger">Dipinjam</span>
                    @endif
                </div>

                <!-- BUTTON -->
                <div class="btn-group">
                    <a href="{{ route('petugas.buku.show', $item->id) }}" class="btn-sm btn-detail">Detail</a>
                    <a href="{{ route('petugas.buku.edit', $item->id) }}" class="btn-sm btn-edit">Edit</a>

                  <form action="{{ route('petugas.buku.delete', $item->id) }}" method="POST" style="display:inline;">
                 @csrf
                 @method('DELETE')
                    <button type="submit" class="btn-sm btn-delete">Delete</button>
                    </form>
                </div>

            </div>
        </div>
        @endforeach

    </div>

    <!-- FOOTER -->
    <div class="footer">
        Copyright © 2019-2026
    </div>

</div>

@endsection
