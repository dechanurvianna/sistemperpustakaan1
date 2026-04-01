@extends('layouts.backend.app')

@section('title', 'Data Pengembalian')

@section('content')

<div style="padding:30px;">

    <h3 style="margin-bottom:20px;">📚 Data Pengembalian Buku</h3>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; background:white;">

        <tr style="background:#f2f2f2;">
            <th>No</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Tanggal Kembali</th>
            <th>Terlambat (hari)</th>
            <th>Denda</th>
        </tr>

        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->judul_buku }}</td>
            <td>{{ $item->tanggal_peminjaman }}</td>
            <td>{{ $item->jatuh_tempo }}</td>
            <td>{{ $item->tanggal_pengembalian }}</td>
            <td>{{ $item->keterlambatan }}</td>
            <td>Rp {{ number_format($item->denda, 0, ',', '.') }}</td>
        </tr>
        @endforeach

        @if($data->isEmpty())
        <tr>
            <td colspan="8" style="text-align:center;">Belum ada data pengembalian</td>
        </tr>
        @endif

    </table>

</div>

@endsection
