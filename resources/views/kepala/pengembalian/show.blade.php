@extends('layouts.backend.kepala.app')

@section('content')

<style>
.container {
    background: white;
    margin: 40px auto;
    width: 90%;
    max-width: 700px;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 {
    margin-bottom: 30px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #555;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #f9f9f9;
    color: #333;
}

.badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    color: white;
    display: inline-block;
}

.menunggu { background-color: #f39c12; }
.selesai { background-color: #27ae60; }

.btn {
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 10px;
}

.btn-kembali {
    background-color: #95a5a6;
    color: white;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #777;
    font-size: 14px;
}
</style>

<div class="container">
    <h2>Detail Pengembalian</h2>

    <div class="form-group">
        <label>Nama Pengguna</label>
        <input type="text" value="{{ $data->nama_user }}" readonly>
    </div>

    <div class="form-group">
        <label>Judul Buku</label>
        <input type="text" value="{{ $data->judul_buku }}" readonly>
    </div>

    <div class="form-group">
        <label>Tanggal Pinjam</label>
        <input type="text" value="{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d M Y') }}" readonly>
    </div>

    <div class="form-group">
        <label>Jatuh Tempo</label>
        <input type="text" value="{{ \Carbon\Carbon::parse($data->jatuh_tempo)->format('d M Y') }}" readonly>
    </div>

    <div class="form-group">
        <label>Tanggal Pengembalian</label>
        <input type="text" value="{{ \Carbon\Carbon::parse($data->tanggal_pengembalian)->format('d M Y') }}" readonly>
    </div>

    <div class="form-group">
        <label>Denda</label>
        <input type="text" value="Rp {{ number_format($data->denda, 0, ',', '.') }}" readonly>
    </div>

    <div class="form-group">
        <label>Status Pengembalian</label>
        <div style="margin-top: 8px;">
            <span class="badge @if($data->status == 'menunggu') menunggu @else selesai @endif">
                {{ ucfirst($data->status) }}
            </span>
        </div>
    </div>

    <a href="{{ route('kepala.pengembalian.index') }}" class="btn btn-kembali">Kembali</a>

    <div class="footer">
        © 2026 Sistem Informasi Perpustakaan
    </div>
</div>

@endsection
