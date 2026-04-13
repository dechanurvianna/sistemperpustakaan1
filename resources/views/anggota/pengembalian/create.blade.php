@extends('layouts.backend.anggota.app')

@section('content')

<style>
.container {
    background: white;
    margin: 40px auto;
    width: 90%;
    max-width: 600px;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 { margin-bottom: 20px; }

.form-group { margin-bottom: 15px; }

label { font-weight: 600; }

input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>

<div class="container">
    <h2>Form Pengembalian Buku</h2>

    <form action="{{ route('anggota.peminjaman.ajukan', $data->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama</label>
            <input type="text" value="{{ $data->name }}" readonly>
        </div>

        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" value="{{ $data->judul_buku }}" readonly>
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="text" value="{{ $data->tanggal_pinjam ?? $data->created_at }}" readonly>
        </div>

        <div class="form-group">
            <label>Jatuh Tempo</label>
            <input type="text" value="{{ \Carbon\Carbon::parse($data->jatuh_tempo)->format('d M Y') }}" readonly>
        </div>

        <!-- Hidden input untuk JavaScript parse tanggal jatuh tempo -->
        <input type="hidden" id="jatuh_tempo" value="{{ \Carbon\Carbon::parse($data->jatuh_tempo)->format('Y-m-d') }}">

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_pengembalian" id="tanggal_kembali" value="{{ date('Y-m-d') }}" required>
        </div>

        <!-- 🔥 DENDA -->
        <div class="form-group">
            <label>Denda</label>
            <input type="text" id="denda" value="Rp 0" readonly>
        </div>
        <input type="hidden" name="denda" id="denda_value" value="0">
        <button type="submit">Ajukan Pengembalian</button>
       <a href="{{ route('anggota.peminjaman.index') }}" 
   style="background-color:#95a5a6; padding:10px 20px; border-radius:6px; color:white; text-decoration:none; margin-left:10px;">
    Kembali
</a>
    </form>
</div>

<!-- 🔥 JAVASCRIPT AUTO DENDA -->
<script>
function hitungDenda() {
    let jatuhTempo = new Date(document.getElementById('jatuh_tempo').value);
    let tanggalKembali = new Date(document.getElementById('tanggal_kembali').value);

    // Reset waktu ke 00:00:00 untuk menghindari masalah timezone
    jatuhTempo.setHours(0, 0, 0, 0);
    tanggalKembali.setHours(0, 0, 0, 0);

    let denda = 0;

    if (tanggalKembali > jatuhTempo) {
        let selisihMs = tanggalKembali - jatuhTempo;
        let selisihHari = Math.ceil(selisihMs / (1000 * 60 * 60 * 24));
        denda = selisihHari * 1000; // 1000 per hari
    }

    let dendaInput = document.getElementById('denda');
    let dendaValue = document.getElementById('denda_value');

    dendaInput.value = "Rp " + denda;
    dendaValue.value = denda;

    // 🔥 warna
    if (denda > 0) {
        dendaInput.style.color = 'red';
    } else {
        dendaInput.style.color = 'green';
    }
}

// Hitung denda saat page load
document.addEventListener('DOMContentLoaded', function () {
    hitungDenda();
});

// Hitung denda saat tanggal berubah
document.getElementById('tanggal_kembali').addEventListener('change', hitungDenda);
</script>

@endsection
