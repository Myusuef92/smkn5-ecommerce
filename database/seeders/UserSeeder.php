<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin Pusat
        User::create([
            'name' => 'Administrator Utama',
            'email' => 'admin@smkn5tangerang.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun Pengelola Jurusan
        User::create([
            'name' => 'Pengelola Jurusan RPL',
            'email' => 'rpl@smkn5tangerang.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'pengelola_jurusan',
        ]);
    }
}