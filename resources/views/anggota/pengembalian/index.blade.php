@extends('layouts.backend.anggota.app')

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
            <th>Status</th>
        </tr>

        @forelse($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->name ?? '-' }}</td>
            <td>{{ $item->judul_buku ?? '-' }}</td>
            <td>{{ $item->tanggal_pinjam ?? '-' }}</td>
            <td>{{ $item->jatuh_tempo ?? '-' }}</td>
            <td>{{ $item->tanggal_kembali ?? '-' }}</td>
            <td>
                @if($item->tanggal_kembali && $item->jatuh_tempo)
                    @php
                        $jatuhTempo = \Carbon\Carbon::parse($item->jatuh_tempo);
                        $tanggalKembali = \Carbon\Carbon::parse($item->tanggal_kembali);
                        $hariTerlambat = $tanggalKembali->gt($jatuhTempo) ? $jatuhTempo->diffInDays($tanggalKembali) : 0;
                    @endphp
                    {{ $hariTerlambat }}
                @else
                    -
                @endif
            </td>
            <td>Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}</td>
            <td>
                @if($item->status_pengembalian == 'menunggu')
                    <span style="color:orange;">Menunggu Konfirmasi</span>
                @elseif($item->status_pengembalian == 'selesai')
                    <span style="color:green;">Dikonfirmasi</span>
                @else
                    {{ $item->status_pengembalian ?? '-' }}
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9" style="text-align:center;">Belum ada data pengembalian</td>
        </tr>
        @endforelse

    </table>

</div>

@endsection
