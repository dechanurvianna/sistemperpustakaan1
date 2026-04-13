@extends('layouts.backend.kepala.app')

@section('title', 'Edit Petugas')

@section('content')

<style>
    .card-custom {
        border-radius: 14px;
        border: none;
        background: #fff;
    }

    .form-control {
        border-radius: 8px;
        font-size: 14px;
    }

    .form-label {
        font-weight: 500;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #2d8cf0;
        border: none;
        border-radius: 8px;
        padding: 8px 20px;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>

<div class="card card-custom p-4 shadow-sm">

    <h4 class="mb-4">Edit Petugas</h4>

    <form action="{{ route('kepala.petugas.update', $petugas->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $petugas->username }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation">
                </div>

            </div>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('kepala.petugas.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

    </form>

</div>

@endsection