@extends('layouts.backend.petugas.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Profile</h2>

    <!-- Notifikasi sukses -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form edit profile -->
    <form action="{{ route('petugas.profile.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" name="name" value="{{ $petugas->name }}" 
                   class="w-full border px-3 py-2 rounded @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" value="{{ $petugas->email }}" 
                   class="w-full border px-3 py-2 rounded @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
            Simpan Perubahan
        </button>
        <a href="{{ route('petugas.profile') }}" 
           class="ml-2 text-gray-600 hover:underline">Batal</a>
    </form>
</div>
@endsection