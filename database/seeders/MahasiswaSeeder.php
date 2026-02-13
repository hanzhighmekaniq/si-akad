<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Golongan;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaUsers = User::where('role', 'mahasiswa')->get();
        $golongans = Golongan::all();

        for ($i = 1; $i <= 50; $i++) {
            $nim = '2024' . str_pad($i, 4, '0', STR_PAD_LEFT);
            $randomGolongan = $golongans->random();

            $data = [
                'NIM' => $nim,
                'Nama' => "Mahasiswa $i",
                'Alamat' => "Jl. Mahasiswa No. $i",
                'Nohp' => '0812345678' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'Semester' => rand(1, 8),
                'id_Gol' => $randomGolongan->id_Gol,
            ];

            if (isset($mahasiswaUsers[$i - 1])) {
                $data['user_id'] = $mahasiswaUsers[$i - 1]->id;
            }

            Mahasiswa::create($data);
        }
    }
}
