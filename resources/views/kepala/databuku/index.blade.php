@extends('layouts.backend.kepala.app')

@section('content')

<style>
    body {
        background: #f1f5f9;
    }

    .card {
        background: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        transition: 0.3s;
        margin-bottom: 40px;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        color: #1e293b;
        margin-bottom: 20px;
        border-left: 6px solid #2563eb;
        padding-left: 12px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom th {
        padding: 12px;
        font-size: 13px;
        text-transform: uppercase;
    }

    .table-custom td {
        padding: 12px;
        font-size: 14px;
    }

    .table-custom tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: 0.2s;
    }

    .table-custom tbody tr:hover {
        background: #f1f5ff;
    }

    .badge-tersedia {
        background: #dcfce7;
        color: #16a34a;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }

    .badge-dipinjam {
        background: #fee2e2;
        color: #dc2626;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
    }
</style>

<div class="max-w-6xl mx-auto mt-10">

    <!-- ================= KATALOG ================= -->
    <div class="card">
        <h2 class="card-title">📚 Data Katalog Buku</h2>

        <div class="overflow-x-auto">
            <table class="table-custom">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Nama Peminjam</th>
                        <th>Stok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($buku as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><b>{{ $item->judul }}</b></td>
                        <td><i>{{ $item->pengarang }}</i></td>
                        <td>{{ $item->penerbit }}</td>
                        <td>{{ $item->tahun }}</td>

                        <!-- NAMA PEMINJAM -->
                        <td>
                            {{ $item->peminjaman->nama_peminjam ?? '-' }}
                        </td>

                        <td>{{ $item->stok }}</td>
                        <td>
                            @if($item->stok > 0)
                                <span class="badge-tersedia">Tersedia</span>
                            @else
                                <span class="badge-dipinjam">Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= KATEGORI ================= -->
    <div class="card">
        <h2 class="card-title">🗂 Data Kategori</h2>

        <div class="overflow-x-auto">
            <table class="table-custom">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><b>{{ $item->nama_kategori }}</b></td>
                        <td><i>{{ $item->deskripsi ?? '-' }}</i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection