<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongan = [
            ['id_Gol' => 'TI-A', 'nama_Gol' => 'Teknik Informatika A'],
            ['id_Gol' => 'TI-B', 'nama_Gol' => 'Teknik Informatika B'],
            ['id_Gol' => 'SI-A', 'nama_Gol' => 'Sistem Informasi A'],
            ['id_Gol' => 'SI-B', 'nama_Gol' => 'Sistem Informasi B'],
            ['id_Gol' => 'MI-A', 'nama_Gol' => 'Manajemen Informatika A'],
        ];

        foreach ($golongan as $gol) {
            Golongan::firstOrCreate(['id_Gol' => $gol['id_Gol']], $gol);
        }
    }
}
