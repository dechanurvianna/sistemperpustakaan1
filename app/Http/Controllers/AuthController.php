<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function register(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        // INSERT USER
        DB::table('users')->insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // AMBIL DATA USER
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        // SIMPAN SESSION
        session([
            'user_id' => $user->id,
            'username' => $user->username,
            'role' => $user->role
        ]);

        return redirect('/dashboard-anggota');
    }

    public function login(Request $request)
    {
        // VALIDASI
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // CARI USER
        $user = DB::table('users')
            ->where('username', $request->username)
            ->first();

        // CEK PASSWORD
        if ($user && Hash::check($request->password, $user->password)) {

            // SIMPAN SESSION
            session([
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role
            ]);

            // REDIRECT SESUAI ROLE
            if ($user->role == 'petugas') {
                return redirect('/dashboard-petugas');
            } elseif ($user->role == 'anggota') {
                return redirect('/dashboard-anggota');
            } elseif ($user->role == 'kepala') {
                return redirect('/dashboard-kepala');
            } else {
                return redirect('/login');
            }
        }

        return back()->with('error', 'Username atau Password salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
