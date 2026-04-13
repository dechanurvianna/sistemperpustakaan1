@extends('layouts.backend.kepala.app')

@section('title', 'Data Petugas')

@section('content')

<style>
    .card-custom {
        border-radius: 14px;
        border: none;
        background: #fff;
    }

    .btn-primary {
        background-color: #2d8cf0;
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
    }

    .btn-danger {
        border-radius: 8px;
    }

    .btn-warning {
        border-radius: 8px;
    }

    .btn-sm {
        padding: 4px 12px;
        font-size: 13px;
    }

    .table th {
        background: #f1f3f5;
        text-align: center;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .d-flex form {
        margin: 0;
    }
</style>

<div class="card card-custom p-4 shadow-sm">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Petugas</h4>
        <a href="{{ route('kepala.petugas.create') }}" class="btn btn-primary">
            + Tambah Petugas
        </a>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($petugas as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <!-- USERNAME -->
                    <td>{{ $p->username }}</td>

                    <!-- PASSWORD -->
                    <td>******</td>

                    <!-- ROLE -->
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $p->role }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">

                            <a href="{{ route('kepala.petugas.edit', $p->id) }}" 
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('kepala.petugas.delete', $p->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Data petugas belum ada</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        {{ $petugas->links() }}
    </div>

</div>

@endsection