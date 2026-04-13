@extends('layouts.backend.petugas.app')

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

.dipinjam { background-color: #27ae60; }
.ditolak { background-color: #e74c3c; }
.pending { background-color: #f39c12; }

.btn {
    padding: 6px 14px;
    border-radius: 20px;
    border: none;
    font-size: 12px;
    cursor: pointer;
}

.btn-acc {
    background-color: #3498db;
    color: white;
}

.btn-tolak {
    background-color: #e74c3c;
    color: white;
    margin-left: 5px;
}

.footer {
    text-align: center;
    margin-top: 20px;
    color: #777;
    font-size: 14px;
}
</style>

<div class="container">
    <h2>Data Peminjaman</h2>

    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->judul_buku }}</td>
                <td>{{ $row->peminjam }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d M Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($row->jatuh_tempo)->format('d M Y') }}</td>
                    <td>{{ $row->tanggal_pengembalian ? \Carbon\Carbon::parse($row->tanggal_pengembalian)->format('d M Y') : '-' }}</td>
                <td>
                    <span class="badge 
                        @if($row->status == 'menunggu') pending
                        @elseif($row->status == 'dipinjam') dipinjam
                        @else {{ $row->status == 'ditolak' ? 'ditolak' : 'pending' }} @endif">
                        {{ ucfirst($row->status) }}
                    </span>
                </td>
                <td>
                    <!-- Form Acc -->
                    @if($row->status == 'menunggu')
                        <form action="{{ route('petugas.peminjaman.acc', $row->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-acc" onclick="return confirm('Yakin ingin menyetujui peminjaman ini?')">Acc</button>
                        </form>

                        <!-- Form Tolak -->
                        <form action="{{ route('petugas.peminjaman.tolak', $row->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-tolak" onclick="return confirm('Yakin ingin menolak peminjaman ini?')">Tolak</button>
                        </form>
                    @else
                        <span style="color:gray;">{{ $row->status == 'ditolak' ? 'Ditolak' : 'Sudah diproses' }}</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        © 2026 Sistem Informasi Perpustakaan
    </div>
</div>

@endsection