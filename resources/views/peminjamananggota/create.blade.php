@extends('layouts.backend.app')

@section('content')

<div style="background-color: #f3f4f6; min-height: 100vh;" class="d-flex flex-column">

    <!-- HEADER -->
    <div class="d-flex justify-content-end align-items-center p-3">
        <span class="me-3">🔔</span>
        <img src="https://i.pravatar.cc/40" class="rounded-circle" alt="user">
        <span class="ms-2">Bonnie Green</span>
    </div>

    <!-- FORM -->
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow p-4" style="width: 500px; border-radius: 12px;">

            {{-- ✅ SUCCESS ALERT --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Judul Buku</label>
                    <input type="text" name="judul_buku"
                           class="form-control"
                           value="{{ $buku->judul ?? '' }}"
                           readonly>
                </div>

                <div class="mb-3">
                    <label>Tanggal Peminjaman</label>
                    <input type="date" name="tanggal_peminjaman"
                           class="form-control"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label>Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo"
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Tanggal Pengembalian</label>
                    <input type="date" name="tanggal_pengembalian" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <input type="text" name="status"
                           class="form-control"
                           value="dipinjam" readonly>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary me-2 px-4">Pinjam</button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary px-4">
                    Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="text-center text-muted pb-3">
        Copyright © 2019-2026
    </div>

</div>

@endsection
