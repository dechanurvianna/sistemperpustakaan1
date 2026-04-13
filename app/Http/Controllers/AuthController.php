<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    // ================= REGISTER =================
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('anggota.dashboard');
    }

    // ================= LOGIN =================
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);

    $user = User::where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {

        Auth::login($user);
        // $request->session()->regenerate();

        // ❌ HAPUS dd() YANG INI
        // dd(Auth::check(), Auth::user());

        // ✅ Redirect sesuai role
        if ($user->role === 'petugas') {
            return redirect()->route('petugas.dashboard');
        } elseif ($user->role === 'kepala') {
            return redirect()->route('kepala.dashboard');
        }

        return redirect()->route('anggota.dashboard');
    }

    return back()->with('error', 'Username atau Password salah');
}

    // ================= LOGOUT =================
    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
