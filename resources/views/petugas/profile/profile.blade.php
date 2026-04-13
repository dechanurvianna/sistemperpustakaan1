@extends('layouts.backend.petugas.app')

@section('content')

<style>
    .profile-wrapper {
        max-width: 900px;
        margin: 40px auto;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(135deg, #2563eb, #1e40af);
        padding: 30px;
        color: white;
        text-align: center;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: white;
        color: #2563eb;
        font-size: 30px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
    }

    .profile-body {
        padding: 30px;
    }

    .profile-item {
        display: flex;
        justify-content: space-between;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        background: #f8fafc;
        transition: 0.3s;
    }

    .profile-item:hover {
        background: #eef2ff;
        transform: translateX(5px);
    }

    .label {
        color: #6b7280;
        font-size: 14px;
    }

    .value {
        font-weight: 600;
        color: #111827;
    }

    .role {
        color: #2563eb;
        font-weight: bold;
    }
</style>

<div class="profile-wrapper">

    <div class="profile-card">

        <!-- HEADER -->
        <div class="profile-header">
            <div class="profile-avatar">
                {{ strtoupper(substr($petugas->name, 0, 1)) }}
            </div>
            <h2 class="text-xl font-semibold">{{ $petugas->name }}</h2>
            <p class="text-sm opacity-80">{{ $petugas->email }}</p>
        </div>

        <!-- BODY -->
        <div class="profile-body">

            <div class="profile-item">
                <span class="label">Nama</span>
                <span class="value">{{ $petugas->name }}</span>
            </div>

            <div class="profile-item">
                <span class="label">Email</span>
                <span class="value">{{ $petugas->email }}</span>
            </div>

            <div class="profile-item">
                <span class="label">Role</span>
                <span class="value role">{{ ucfirst($petugas->role) }}</span>
            </div>

            <div class="profile-item">
                <span class="label">Dibuat pada</span>
                <span class="value">{{ $petugas->created_at->format('d M Y') }}</span>
            </div>

        </div>

    </div>

</div>

@endsection