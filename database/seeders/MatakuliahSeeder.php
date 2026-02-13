<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matakuliah = [
            ['Kode_mk' => 'MK001', 'Nama_mk' => 'Pemrograman Web', 'sks' => 3, 'semester' => 3],
            ['Kode_mk' => 'MK002', 'Nama_mk' => 'Basis Data', 'sks' => 3, 'semester' => 3],
            ['Kode_mk' => 'MK003', 'Nama_mk' => 'Struktur Data', 'sks' => 3, 'semester' => 2],
            ['Kode_mk' => 'MK004', 'Nama_mk' => 'Algoritma Pemrograman', 'sks' => 3, 'semester' => 1],
            ['Kode_mk' => 'MK005', 'Nama_mk' => 'Jaringan Komputer', 'sks' => 3, 'semester' => 4],
            ['Kode_mk' => 'MK006', 'Nama_mk' => 'Sistem Operasi', 'sks' => 3, 'semester' => 4],
            ['Kode_mk' => 'MK007', 'Nama_mk' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 5],
            ['Kode_mk' => 'MK008', 'Nama_mk' => 'Kecerdasan Buatan', 'sks' => 3, 'semester' => 6],
            ['Kode_mk' => 'MK009', 'Nama_mk' => 'Mobile Programming', 'sks' => 3, 'semester' => 5],
            ['Kode_mk' => 'MK010', 'Nama_mk' => 'Data Mining', 'sks' => 3, 'semester' => 6],
        ];

        foreach ($matakuliah as $mk) {
            Matakuliah::create($mk);
        }
    }
}
