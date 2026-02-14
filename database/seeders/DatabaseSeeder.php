<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // GolonganSeeder::class,
            // MatakuliahSeeder::class,
            // RuangSeeder::class,
            // DosenSeeder::class,
            // MahasiswaSeeder::class,
            // PengampuSeeder::class,
            // JadwalAkademikSeeder::class,
            // KrsSeeder::class,
            // PresensiAkademikSeeder::class,
            // SetupTodayScheduleSeeder::class,
        ]);
    }
}
