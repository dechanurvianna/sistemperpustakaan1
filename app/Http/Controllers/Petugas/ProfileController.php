<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $petugas = Auth::user();
        return view('petugas.profile.profile', compact('petugas'));
    }

    public function edit()
    {
        $petugas = Auth::user();
        return view('petugas.profile.edit', compact('petugas'));
    }

    public function update(Request $request)
    {
        $petugas = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->save();

        return redirect()->route('petugas.profile')->with('success', 'Profile berhasil diperbarui!');
    }
}