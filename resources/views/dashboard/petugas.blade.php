@extends('layouts.backend.petugas.app')

@section('content')

<div class="container-fluid" style="background:#f3f4f6; min-height:100vh; padding:20px;">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <input type="text" class="form-control w-25" placeholder="Search">

        <div class="d-flex align-items-center">
            <span class="me-3">🔔</span>
            <img src="https://i.pravatar.cc/40" class="rounded-circle me-2">
            <span>{{ Auth::user()->name }}</span>
        </div>
    </div>

    <!-- CARD -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">👥</div>
                    <div>
                        <small>Total Anggota</small>
                        <h5>{{ $totalAnggota }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">📖</div>
                    <div>
                        <small>Total Buku</small>
                        <h5>{{ $totalBuku }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 shadow-sm border-0">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">💲</div>
                    <div>
                        <small>Total Denda</small>
                        <h5>Rp {{ number_format($totalDenda, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <strong>Peminjaman Terbaru</strong>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($peminjaman as $pinjam)
                        <tr>
                            <td>{{ $pinjam->user->name }}</td>
                            <td>{{ $pinjam->buku->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->format('d-m-Y') }}</td>
                            <td>
                                @if ($pinjam->status === 'dipinjam')
                                    <span class="badge bg-danger">Dipinjam</span>
                                @else
                                    <span class="badge bg-primary">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="mt-5 text-muted">
        <small>Copyright © 2019-2026</small>
    </div>

</div>

@endsection