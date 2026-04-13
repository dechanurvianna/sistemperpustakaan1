@extends('layouts.backend.kepala.app')

@section('content')

<style>
.container {
    background: white;
    margin: 40px auto;
    width: 90%;
    max-width: 1100px;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    text-align: left;
    padding: 12px;
    color: #666;
    font-weight: 600;
    border-bottom: 2px solid #eee;
}

td {
    padding: 14px 12px;
    border-bottom: 1px solid #eee;
    color: #444;
}

.badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 13px;
    color: white;
    display: inline-block;
}

.menunggu { background-color: #f39c12; }
.selesai { background-color: #27ae60; }

.btn {
    padding: 6px 14px;
    border-radius: 20px;
    border: none;
    font-size: 12px;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
}

.btn-detail {
    background-color: #3498db;
    color: white;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #777;
    font-size: 14px;
}

.pagination {
    margin-top: 20px;
    text-align: center;
}
</style>

<div class="container">
    <h2>Data Pengembalian (Laporan)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Judul Buku</th>
                <th>Pengembalian Dari</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $key => $row)
            <tr>
                <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
                <td>{{ $row->judul_buku }}</td>
                <td>{{ $row->nama_user }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ $row->tanggal_pengembalian ? \Carbon\Carbon::parse($row->tanggal_pengembalian)->format('d M Y') : '-' }}</td>
                <td>Rp {{ number_format($row->jumlah_denda, 0, ',', '.') }}</td>
                <td>
                    <span class="badge 
                        @if($row->status == 'menunggu') menunggu
                        @else selesai @endif">
                        {{ ucfirst($row->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('kepala.pengembalian.show', $row->id) }}" class="btn btn-detail">Lihat</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:20px;">Tidak ada data pengembalian</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $data->links() }}
    </div>

    <div class="footer">
        © 2026 Sistem Informasi Perpustakaan
    </div>
</div>

@endsection
