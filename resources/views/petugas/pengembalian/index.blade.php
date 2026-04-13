@extends('layouts.backend.petugas.app')

@section('content')
<div style="max-width:1000px; margin:40px auto; font-family:Arial, sans-serif;">

    <h2 style="text-align:center; margin-bottom:20px;">
        Data Pengembalian Buku
    </h2>

    <table border="1" width="100%" cellpadding="10" cellspacing="0" style="border-collapse:collapse; background:#fff;">
        <thead style="background:#4CAF50; color:white;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->nama_user ?? '-' }}</td>
                <td>{{ $item->judul_buku ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') ?? '-' }}</td>

                <td style="color:red; font-weight:bold;">
                    Rp {{ number_format($item->jumlah_denda ?? 0, 0, ',', '.') }}
                </td>

                <td>
                    @if($item->status == 'menunggu')
                        <span style="background:orange; color:white; padding:5px 10px; border-radius:5px;">
                            Menunggu
                        </span>
                    @else
                        <span style="background:green; color:white; padding:5px 10px; border-radius:5px;">
                            Selesai
                        </span>
                    @endif
                </td>

                <td>
                    @if($item->status == 'menunggu')
                        <form action="{{ route('petugas.pengembalian.konfirmasi', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="padding:5px 10px; background:blue; color:white; border:none; border-radius:5px;" onclick="return confirm('Konfirmasi pengembalian ini?')">
                                Konfirmasi
                            </button>
                        </form>
                    @else
                        <span style="color:green;">✓ Selesai</span>
                    @endif
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="9" style="text-align:center;">
                    Data pengembalian belum ada
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection