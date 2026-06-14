<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role'     => 'admin',
            'phone'    => '081234567890',
        ]);

        User::create([
            'name'     => 'Pelanggan Demo',
            'email'    => 'pelanggan@gmail.com',
            'password' => Hash::make('pelanggan123'),
            'role'     => 'pelanggan',
            'phone'    => '082345678901',
        ]);
    }
}
