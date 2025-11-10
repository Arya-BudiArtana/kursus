<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat Pengguna Admin
User::create([
'name' => 'Admin Aplikasi',
'email' => 'admin@simaset.com', // Ganti dengan email Anda
'password' => Hash::make('password123'), // Ganti!
'role' => 'admin',
]);
// 2. Buat Pengguna User (Pegawai)
User::create([
'name' => 'Pegawai Satu',
'email' => 'pegawai1@simaset.com', // Ganti dengan email Anda
'password' => Hash::make('password123'), // Ganti!
'role' => 'pegawai',
]);
    }
}
