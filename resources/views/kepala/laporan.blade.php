@extends('layouts.backend.kepala.app')

@section('title', 'Laporan Peminjaman')

@section('content')

<style>
    body {
        background-color: #f4f6f9;
    }

    .card-custom {
        border-radius: 12px;
        border: none;
        background: #ffffff;
    }

    .judul-laporan {
        font-weight: 600;
        color: #333;
    }

    .filter-title {
        font-weight: 500;
        margin-bottom: 10px;
    }

    .form-control, .form-select {
        border-radius: 8px;
        font-size: 14px;
    }

    label {
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .btn {
        border-radius: 8px;
        padding: 6px 16px;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #2d8cf0;
        border: none;
    }

    .btn-secondary {
        background-color: #adb5bd;
        border: none;
    }

    table {
        border-radius: 10px;
        overflow: hidden;
        font-size: 14px;
    }

    thead {
        background-color: #f1f3f5;
    }

    th {
        font-weight: 600;
        text-align: center;
    }

    td {
        vertical-align: middle;
        text-align: center;
    }

    .table tbody tr:hover {
        background-color: #f9fafb;
    }
</style>

<div class="card p-3 shadow-sm">

    <!-- JUDUL -->
    <h4 class="mb-3">Laporan Peminjaman dan Pengembalian Buku</h4>

    <!-- FILTER -->

    <form class="row g-3 mb-3" method="GET" action="{{ route('kepala.laporan') }}">
        <div class="col-md-3">
            <label>Jenis Laporan</label>
            <select class="form-select" name="jenis_laporan">
                <option value="">Pilih</option>
                <option value="peminjaman" {{ ($jenis ?? '') === 'peminjaman' ? 'selected' : '' }}>Laporan Peminjaman</option>
                <option value="pengembalian" {{ ($jenis ?? '') === 'pengembalian' ? 'selected' : '' }}>Laporan Pengembalian</option>
            </select>
        </div>

        <div class="col-md-3">
            <label>Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" value="{{ $mulai ?? '' }}">
        </div>

        <div class="col-md-3">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" value="{{ $selesai ?? '' }}">
        </div>

        <div class="col-md-3 d-flex align-items-end justify-content-end">
            <button class="btn btn-primary">Tampilkan</button>
        </div>
    </form>

    @if(empty($jenis) || empty($mulai) || empty($selesai))
        <div class="alert alert-info mb-3">
            Pilih jenis laporan dan periode tanggal lalu klik <strong>Tampilkan</strong> untuk melihat data.
        </div>
    @elseif($mulai > $selesai)
        <div class="alert alert-danger mb-3">
            Tanggal mulai tidak boleh lebih besar dari tanggal selesai.
        </div>
    @endif

    <!-- TABLE -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>
        </thead>
            <tbody>
            @if(empty($jenis) || empty($mulai) || empty($selesai))
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Pilih jenis laporan dan rentang tanggal, lalu klik Tampilkan.
                    </td>
                </tr>
            @elseif($mulai > $selesai)
                <tr>
                    <td colspan="7" class="text-center text-danger py-4">
                        Tanggal mulai tidak boleh lebih besar dari tanggal selesai.
                    </td>
                </tr>
            @elseif($data->isEmpty())
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Tidak ada data untuk periode dan jenis laporan yang dipilih.
                    </td>
                </tr>
            @else
                @foreach($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_anggota }}</td>
                        <td>{{ $item->judul_buku }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d-m-Y') }}</td>
                        <td>{{ isset($item->tanggal_kembali) && $item->tanggal_kembali ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') : '-' }}</td>
                        <td>
                            @if($item->status == 'dipinjam')
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success">Dikembalikan</span>
                            @elseif($item->status == 'menunggu')
                                <span class="badge bg-info text-white">Menunggu</span>
                            @elseif($item->status == 'ditolak')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</div>

@endsection
