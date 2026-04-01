@extends('layouts.backend.app')

@section('content')

<div style="background-color: #f3f4f6; min-height: 100vh;" class="d-flex flex-column">

    <!-- HEADER -->
    <div class="d-flex justify-content-end align-items-center p-3">
        <span class="me-3">🔔</span>
        <img src="https://i.pravatar.cc/40" class="rounded-circle">
        <span class="ms-2">Bonnie Green</span>
    </div>

    <!-- CONTENT -->
    <div class="container">

        <h5 class="mb-4">Data Peminjaman</h5>

        <div class="card shadow-sm p-3" style="border-radius: 12px;">
            <table class="table align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul Buku</th>
                        <th>Peminjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ $item->tanggal_peminjaman }}</td>
                        <td>{{ $item->jatuh_tempo }}</td>
                        <td>{{ $item->tanggal_pengembalian ?? '-' }}</td>

                        <!-- STATUS WARNA -->
                        <td>
                            @if($item->status == 'dipinjam')
                                <span class="badge bg-warning text-dark px-3">Dipinjam</span>
                            @elseif($item->status == 'dikembalikan')
                                <span class="badge bg-success px-3">Dikembalikan</span>
                            @elseif($item->status == 'terlambat')
                                <span class="badge bg-danger px-3">Terlambat</span>
                            @endif
                        </td>

                        <!-- AKSI -->
                       <td>
    <!-- tombol detail (tetap ada) -->
    <a href="{{ url('/peminjaman/' . $item->id) }}" class="btn btn-primary">
        Detail
    </a>

    <!-- tombol hapus (tambahan) -->
    <form action="{{ url('/peminjaman/' . $item->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"
            onclick="return confirm('Yakin mau hapus data ini?')">
            Hapus
        </button>
    </form>
</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center text-muted mt-auto pb-3">
        Copyright © 2019-2026
    </div>

</div>

@endsection
