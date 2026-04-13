@extends('layouts.backend.anggota.app')

@section('content')

<div style="background-color: #f3f4f6; min-height: 100vh;" class="d-flex flex-column">

    <!-- HEADER -->
    <div class="d-flex justify-content-end align-items-center p-3">
        <span class="me-3">🔔</span>
        <img src="https://i.pravatar.cc/40" class="rounded-circle" alt="user">
        <span class="ms-2">{{ auth()->user()->name }}</span>
    </div>

    <!-- FORM -->
    <div class="d-flex justify-content-center align-items-center flex-grow-1">
        <div class="card shadow p-4" style="width: 500px; border-radius: 12px;">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- ERROR --}}
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- VALIDATION --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
                @csrf

                {{-- USER --}}
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" class="form-control"
                           value="{{ auth()->user()->name }}" readonly>
                </div>

                {{-- 🔥 PENTING --}}
                <input type="hidden" name="buku_id" value="{{ $buku->id }}">

                {{-- JUDUL --}}
                <div class="mb-3">
                    <label>Judul Buku</label>
                    <input type="text" class="form-control"
                           value="{{ $buku->judul }}" readonly>
                </div>

                {{-- TANGGAL PINJAM (OTOMATIS HARI INI) --}}
                <div class="mb-3">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam"
                           class="form-control"
                           id="tanggal_pinjam"
                           value="{{ date('Y-m-d') }}" readonly>
                </div>

                {{-- JATUH TEMPO (OTOMATIS 7 HARI KEMUDIAN) --}}
                <div class="mb-3">
                    <label>Jatuh Tempo (7 hari)</label>
                    <input type="date" class="form-control"
                           id="jatuh_tempo"
                           value="{{ date('Y-m-d', strtotime('+7 days')) }}"
                           readonly>
                </div>

                {{-- JATUH TEMPO HIDDEN UNTUK DATABASE --}}
                <input type="hidden" name="jatuh_tempo"
                       id="jatuh_tempo_hidden"
                       value="{{ date('Y-m-d', strtotime('+7 days')) }}">

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary me-2 px-4">Pinjam</button>
                    <a href="{{ route('anggota.peminjaman.index') }}" class="btn btn-secondary px-4">Kembali</a>
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