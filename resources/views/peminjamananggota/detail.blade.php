@extends('layouts.backend.app')

@section('title', 'Detail Peminjaman')

@section('content')

<div style="display:flex; justify-content:center; align-items:center; height:80vh;">

    <div style="
        width:500px;
        background:white;
        padding:30px;
        border-radius:10px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom:25px; text-align:center;">
            Detail Peminjaman
        </h3>

        <table style="width:100%;">

            <tr>
                <td style="padding:10px 0;">Judul Buku</td>
                <td>:</td>
                <td>
                    <input type="text" value="{{ $peminjaman->judul_buku }}" readonly>
                </td>
            </tr>

            <tr>
                <td style="padding:10px 0;">Tanggal Peminjaman</td>
                <td>:</td>
                <td>
                    <input type="text" value="{{ $peminjaman->tanggal_peminjaman }}" readonly>
                </td>
            </tr>

            <tr>
                <td style="padding:10px 0;">Jatuh Tempo</td>
                <td>:</td>
                <td>
                    <input type="text" value="{{ $peminjaman->jatuh_tempo }}" readonly>
                </td>
            </tr>

            <tr>
                <td style="padding:10px 0;">Status</td>
                <td>:</td>
                <td>
                    <input type="text" value="{{ $peminjaman->status }}" readonly>
                </td>
            </tr>

        </table>

        <!-- INFO -->
        <div style="text-align:center; margin-top:20px; color:#666;">

        </div>

        <!-- BUTTON -->
        <div style="text-align:center; margin-top:25px;">
            <button
                onclick="history.back()"
                style="
                    background:gray;
                    color:white;
                    padding:10px 20px;
                    border:none;
                    border-radius:5px;
                    cursor:pointer;
                ">
                Kembali
            </button>
        </div>

    </div>

</div>

@endsection
