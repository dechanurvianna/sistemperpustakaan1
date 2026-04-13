@extends('layouts.backend.kepala.app')

@section('content')

<div class="container-fluid" style="background:#f3f4f6; min-height:100vh; padding:20px;">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold">🏠 Dashboard Kepala Perpustakaan</h5>

        <div class="d-flex align-items-center">
            <span class="me-3">🔔</span>
            <img src="https://i.pravatar.cc/40" class="rounded-circle me-2">
            <span>{{ Auth::user()->name }}</span>
        </div>
    </div>

    {{-- CARDS STATISTIK --}}
    <div class="row mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card p-3 shadow-sm border-0" style="border-left: 4px solid #3b82f6;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">📚</div>
                    <div>
                        <small class="text-muted">Total Buku</small>
                        <h5 class="mb-0 fw-bold">{{ $totalBuku }}</h5>
                        <small class="text-muted">Koleksi buku</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card p-3 shadow-sm border-0" style="border-left: 4px solid #10b981;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">👥</div>
                    <div>
                        <small class="text-muted">Total Anggota</small>
                        <h5 class="mb-0 fw-bold">{{ $totalAnggota }}</h5>
                        <small class="text-muted">Member terdaftar</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card p-3 shadow-sm border-0" style="border-left: 4px solid #eab308;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">📤</div>
                    <div>
                        <small class="text-muted">Sedang Dipinjam</small>
                        <h5 class="mb-0 fw-bold">{{ $bukuDipinjam }}</h5>
                        <small class="text-muted">Dalam peminjaman</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card p-3 shadow-sm border-0" style="border-left: 4px solid #ef4444;">
                <div class="d-flex align-items-center">
                    <div class="me-3 fs-3">⏰</div>
                    <div>
                        <small class="text-muted">Terlambat</small>
                        <h5 class="mb-0 fw-bold">{{ $terlambat }}</h5>
                        <small class="text-muted">Belum dikembalikan</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AKTIVITAS TERBARU --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <strong>📋 Aktivitas Transaksi Terbaru (10 transaksi)</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Tanggal Pinjam</th>
                            <th>Nama Anggota</th>
                            <th>Judul Buku</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($aktivitas as $item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                            <td>{{ $item->nama_anggota }}</td>
                            <td>{{ $item->judul_buku }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d-m-Y') }}</td>
                            <td>
                                @if($item->status == 'dipinjam')
                                    <span class="badge bg-warning text-dark">🔄 Dipinjam</span>
                                @elseif($item->status == 'selesai')
                                    <span class="badge bg-success">✅ Dikembalikan</span>
                                @elseif($item->status == 'menunggu')
                                    <span class="badge bg-info">⏳ Menunggu</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="badge bg-danger">❌ Ditolak</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Tidak ada aktivitas transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <div class="mt-5 text-muted">
        <small>Copyright © 2019-2026</small>
    </div>

</div>
@endsection