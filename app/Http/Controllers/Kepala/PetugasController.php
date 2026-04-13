<?php

namespace App\Http\Controllers\Kepala; // namespace controller untuk bagian kepala

use App\Http\Controllers\Controller; // parent controller Laravel
use Illuminate\Http\Request; // untuk handle request dari form
use App\Models\User; // model User (tabel users)
use Illuminate\Support\Facades\Hash; // untuk enkripsi password

class PetugasController extends Controller
{
    public function index()
    {
        // ambil data user yang role-nya hanya 'petugas'
        $petugas = User::where('role', 'petugas')->paginate(10);

        // kirim data ke view index
        return view('kepala.petugas.index', compact('petugas'));
    }

    public function create()
    {
        // tampilkan halaman form tambah petugas
        return view('kepala.petugas.create');
    }

    public function store(Request $request)
    {
        // validasi input dari form
        $request->validate([
            'username' => 'required|unique:users,username', // username wajib & tidak boleh sama
            'password' => 'required|confirmed|min:6', // password wajib, min 6, harus sama dengan konfirmasi
        ]);

        // simpan data ke database
        User::create([
            'name' => $request->username, // isi name dari username
            'username' => $request->username, // username
            'email' => $request->username . '@gmail.com', // email otomatis
            'password' => Hash::make($request->password), // enkripsi password
            'role' => 'petugas', // set otomatis jadi petugas
        ]);

        // redirect ke halaman index + pesan sukses
        return redirect()->route('kepala.petugas.index')
            ->with('success', 'Petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        // ambil data petugas berdasarkan id
        $petugas = User::findOrFail($id);

        // kirim ke halaman edit
        return view('kepala.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        // ambil data petugas
        $petugas = User::findOrFail($id);

        // validasi username (boleh sama dengan dirinya sendiri)
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
        ]);

        // data yang akan diupdate
        $data = [
            'name' => $request->username, // update name
            'username' => $request->username, // update username
            'role' => 'petugas', // tetap paksa jadi petugas
        ];

        // cek jika password diisi
        if ($request->password) {

            // validasi password
            $request->validate([
                'password' => 'confirmed|min:6'
            ]);

            // update password (dienkripsi)
            $data['password'] = Hash::make($request->password);
        }

        // update data ke database
        $petugas->update($data);

        // redirect ke index + pesan sukses
        return redirect()->route('kepala.petugas.index')
            ->with('success', 'Petugas berhasil diupdate');
    }

    public function destroy($id)
    {
        // ambil data petugas
        $petugas = User::findOrFail($id);

        // hapus data
        $petugas->delete();

        // redirect + pesan sukses
        return redirect()->route('kepala.petugas.index')
            ->with('success', 'Petugas berhasil dihapus');
    }
}