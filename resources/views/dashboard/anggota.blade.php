@extends('layouts.backend.anggota.app')

@section('content')
<div class="d-flex">

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light">

        <!-- Header -->
        <div class="d-flex justify-content-between mb-4">
            <input type="text" class="form-control w-25" placeholder="Search">
            <div>👤 Anggota</div>
        </div>

        <!-- Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h6>Buku Sedang Dipinjam</h6>
                    <h4>2</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h6>Jatuh Tempo</h6>
                    <h4>7 Hari</h4>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-3 text-center">
                    <h6>Info Denda</h6>
                    <h4>Rp 10.000</h4>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="card p-3">
            <h6 class="mb-3">Buku Peminjaman</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laskar Langit</td>
                        <td>Andrie Harta</td>
                        <td>05-03-2025</td>
                        <td>19-03-2025</td>
                        <td><span class="badge bg-danger">Dipinjam</span></td>
                    </tr>
                    <tr>
                        <td>Gadis Kecil</td>
                        <td>Ratu Kumala</td>
                        <td>15-02-2025</td>
                        <td>30-02-2025</td>
                        <td><span class="badge bg-primary">Pinjam</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <footer class="mt-4 text-center">
            <small>Copyright © 2019-2026</small>
        </footer>

    </div>
</div>
@endsection
