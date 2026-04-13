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

                <h5 class="mb-4 fw-bold">Edit Buku</h5>

                {{-- ERROR --}}
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

                <form action="{{ route('petugas.buku.update', $buku->id ?? 0) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" name="judul" value="{{ $buku->judul ?? '' }}" class="form-control">
                    </div>

                    <!-- Pengarang & Penerbit -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pengarang</label>
                            <input type="text" name="pengarang" value="{{ $buku->pengarang ?? '' }}" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" value="{{ $buku->penerbit ?? '' }}" class="form-control">
                        </div>
                    </div>

                    <!-- Tahun -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" value="{{ $buku->isbn ?? '' }}" class="form-control">
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="mb-3">
                            <label>Tahun Terbit</label>
                             <input type="number" name="tahun_terbit" class="form-control">
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6 mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ $buku->kategori_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                             @endforeach
                         </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stok" value="{{ $buku->stok ?? 0 }}" class="form-control" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4">{{ $buku->deskripsi ?? '' }}</textarea>
                    </div>

                    <!-- Gambar -->
                    <div class="mb-4">
                        <label class="form-label">Gambar Buku</label>

                        <div class="upload-box text-center p-4">
                            @if(!empty($buku->gambar))
                                <img src="{{ asset('storage/' . $buku->gambar) }}" width="80" class="mb-2">
                            @endif

                            <p class="text-muted">Ganti gambar (opsional)</p>

                            <input type="file" name="gambar" id="fileInput" hidden>

                            <button type="button" class="btn btn-info btn-sm text-white"
                                onclick="document.getElementById('fileInput').click()">
                                Pilih Gambar
                            </button>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">Update</button>

                        <a href="{{ route('petugas.data-buku') }}" class="btn btn-secondary px-4">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

        <p class="text-muted mt-4 small">Copyright © 2019-2026</p>

    </div>

</div>

@endsection
