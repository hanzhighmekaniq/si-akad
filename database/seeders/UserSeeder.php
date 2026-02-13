<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin users
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Admin Staff',
            'email' => 'staff@siakad.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Dosen users
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => "Dosen User $i",
                'email' => "dosen$i@siakad.com",
                'password' => Hash::make('password'),
                'role' => 'dosen',
                'email_verified_at' => now(),
            ]);
        }

        // Mahasiswa users
        for ($i = 1; $i <= 50; $i++) {
            User::create([
                'name' => "Mahasiswa User $i",
                'email' => "mahasiswa$i@siakad.com",
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'email_verified_at' => now(),
            ]);
        }
    }
}
