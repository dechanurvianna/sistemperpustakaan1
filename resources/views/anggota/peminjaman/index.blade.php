@extends('layouts.backend.anggota.app')

@section('content')

<div style="background-color: #f3f4f6; min-height: 100vh;" class="d-flex flex-column">

    <!-- HEADER -->
    <div class="d-flex justify-content-end align-items-center p-3">
        <span class="me-3">🔔</span>
        <img src="https://i.pravatar.cc/40" class="rounded-circle">
        <span class="ms-2">{{ auth()->user()->name }}</span>
    </div>

    <!-- CONTENT -->
    <div class="container">

        <h5 class="mb-4">Data Peminjaman</h5>

        <div class="card shadow-sm p-3" style="border-radius: 12px;">
            <table class="table align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d M Y') }}</td>

                        <!-- STATUS WARNA -->
                        <td>
                            @if($item->status == 'menunggu')
                                <span class="badge bg-warning text-dark px-3">Menunggu Konfirmasi</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="badge bg-info text-white px-3">Sedang Dipinjam</span>
                            @elseif($item->status == 'menunggu_pengembalian')
                                <span class="badge bg-primary text-white px-3">Menunggu Pengembalian</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success px-3">Selesai</span>
                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger px-3">Ditolak</span>
                            @else
                                <span class="badge bg-secondary px-3">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>

                    <!-- AKSI -->
                       <td>
                    @if($item->status == 'dipinjam')
                    <a href="{{ route('anggota.peminjaman.formPengembalian', $item->id) }}">
                    <button type="button" class="btn btn-primary btn-sm">Ajukan Pengembalian</button>
                    </a>
                    @elseif($item->status == 'menunggu')
                    <span style="color:orange;">Menunggu...</span>
                    @endif

                    </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px;">Belum ada peminjaman</td>
                    </tr>
                    @endforelse

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
