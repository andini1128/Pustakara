<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin default
        User::updateOrCreate(['username' => 'admin'], [
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@pustakara.test',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // Buat akun petugas contoh
        User::updateOrCreate(['username' => 'petugas'], [
            'name'     => 'petugas1@pustakara',
            'username' => 'petugas',
            'email'    => 'petugas@pustakara.test',
            'password' => Hash::make('petugas123'),
            'role'     => 'petugas',
        ]);
    }
}
