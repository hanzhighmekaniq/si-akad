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
        User::updateOrCreate(
            ['email' => 'admin@siakad.com'],
            ['name' => 'Admin Utama', 'password' => Hash::make('password'), 'role' => 'admin', 'email_verified_at' => now()]
        );
        User::updateOrCreate(
            ['email' => 'staff@siakad.com'],
            ['name' => 'Admin Staff', 'password' => Hash::make('password'), 'role' => 'admin', 'email_verified_at' => now()]
        );

        // Dosen users
        for ($i = 1; $i <= 10; $i++) {
            User::updateOrCreate(
                ['email' => "dosen$i@siakad.com"],
                ['name' => "Dosen User $i", 'password' => Hash::make('password'), 'role' => 'dosen', 'email_verified_at' => now()]
            );
        }

        // Mahasiswa users
        for ($i = 1; $i <= 50; $i++) {
            User::updateOrCreate(
                ['email' => "mahasiswa$i@siakad.com"],
                ['name' => "Mahasiswa User $i", 'password' => Hash::make('password'), 'role' => 'mahasiswa', 'email_verified_at' => now()]
            );
        }
    }
}
