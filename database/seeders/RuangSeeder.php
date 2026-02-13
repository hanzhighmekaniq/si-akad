<?php

namespace Database\Seeders;

use App\Models\Ruang;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ruang = [
            ['id_ruang' => 'R101', 'nama_ruang' => 'Lab Komputer 1'],
            ['id_ruang' => 'R102', 'nama_ruang' => 'Lab Komputer 2'],
            ['id_ruang' => 'R103', 'nama_ruang' => 'Lab Komputer 3'],
            ['id_ruang' => 'R201', 'nama_ruang' => 'Ruang Kelas 201'],
            ['id_ruang' => 'R202', 'nama_ruang' => 'Ruang Kelas 202'],
            ['id_ruang' => 'R203', 'nama_ruang' => 'Ruang Kelas 203'],
            ['id_ruang' => 'R301', 'nama_ruang' => 'Ruang Kuliah Besar'],
        ];

        foreach ($ruang as $r) {
            Ruang::create($r);
        }
    }
}
