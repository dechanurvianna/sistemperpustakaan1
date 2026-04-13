@extends('layouts.backend.petugas.app')

@section('content')

<style>
.container {
    background: white;
    margin: 30px auto;
    width: 90%;
    max-width: 1000px;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

h2 {
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

th {
    color: #666;
}

tr:hover {
    background-color: #f9f9f9;
}

.badge {
    padding: 5px 10px;
    border-radius: 15px;
    background: #27ae60;
    color: white;
    font-size: 12px;
}

.btn {
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

.btn-hapus {
    background: #e74c3c;
    color: white;
}
</style>

<div class="container">
    <h2>Data Anggota</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($anggota as $index => $row)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->username }}</td>
                <td>{{ $row->email }}</td>
                <td><span class="badge">{{ $row->role }}</span></td>
                <td>
                    <!-- Form hapus -->
                    <form action="{{ route('petugas.anggota.delete', $row->id) }}" method="POST">
                     @csrf
                    @method('DELETE')
                     <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
