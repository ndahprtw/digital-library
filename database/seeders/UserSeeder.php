<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make(123456),
        ]);
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'role' => 'petugas',
            'password' => Hash::make(123456),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'User@gmail.com',
            'role' => 'user',
            'password' => Hash::make(123456),
        ]);
    }
}
