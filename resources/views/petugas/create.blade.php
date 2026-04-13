@extends('layouts.backend.petugas.app')

@section('content')

<style>
    body { margin: 0; }

    .content-wrapper {
        background-color: #f5f6fa;
        min-height: 100vh;
        padding: 30px;
    }

    .card-form {
        max-width: 700px;
        margin: auto;
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .upload-box {
        border: 2px dashed #dcdde1;
        border-radius: 10px;
        background-color: #fafafa;
        cursor: pointer;
        transition: 0.3s;
    }

    .upload-box:hover {
        background-color: #f1f2f6;
    }
</style>

<div class="d-flex">

    @include('layouts.backend.petugas.sidebar')

    <div class="flex-grow-1 content-wrapper">

        <div class="card card-form">
            <div class="card-body p-4">

                <h5 class="mb-4 fw-bold">Tambah Buku</h5>

                {{-- ERROR VALIDATION --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ implode('', $errors->all(':message')) }}
                    </div>
                @endif

                {{-- SUCCESS --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('petugas.buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" class="form-control">
                    </div>

                    <!-- Pengarang & Penerbit -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengarang</label>
                            <input type="text" name="pengarang" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control">
                        </div>
                    </div>

                    <!-- Tahun & Kategori -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control">
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="mb-3">
                             <label>Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" class="form-control">
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_kategori }}
                        </option>
                            @endforeach
                         </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control" value="0" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="mb-4">
                        <label class="form-label">Gambar</label>

                        <div class="upload-box text-center p-4">
                            <div class="mb-2" style="font-size: 30px;">☁️</div>
                            <p class="mb-2 text-muted">Pilih gambar</p>

                            <input type="file" name="gambar" id="fileInput" hidden>

                            <button type="button" class="btn btn-info btn-sm text-white"
                                onclick="document.getElementById('fileInput').click()">
                                Pilih Gambar
                            </button>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        <button type="button" onclick="window.history.back()" class="btn btn-secondary px-4">
                        Batal
                        </button>
                    </div>

                </form>

            </div>
        </div>

        <p class="text-muted mt-4 small">Copyright © 2019-2026</p>

    </div>

</div>

@endsection
