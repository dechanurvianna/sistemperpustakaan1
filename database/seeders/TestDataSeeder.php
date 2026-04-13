<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Petugas\Buku;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create test anggota
        User::create([
            'name' => 'Anggota Test',
            'email' => 'anggota@test.com',
            'username' => 'anggota_test',
            'password' => Hash::make('password'),
            'role' => 'anggota'
        ]);

        // Create test buku
        Buku::create([
            'judul' => 'Buku Test',
            'pengarang' => 'Pengarang Test',
            'isbn' => '123456789',
            'status' => 'tersedia'
        ]);

        // Create test petugas
        User::create([
            'name' => 'Petugas Test',
            'email' => 'petugas@test.com',
            'username' => 'petugas_test',
            'password' => Hash::make('password'),
            'role' => 'petugas'
        ]);

        // Create test kepala
        User::create([
            'name' => 'Kepala Test',
            'email' => 'kepala@test.com',
            'username' => 'kepala_test',
            'password' => Hash::make('password'),
            'role' => 'kepala'
        ]);
    }
}