<?php

namespace Database\Seeders;

use App\Models\Pengampu;
use App\Models\Dosen;
use App\Models\Matakuliah;
use Illuminate\Database\Seeder;

class PengampuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosens = Dosen::all();
        $matakuliahs = Matakuliah::all();

        // Assign each matakuliah to 1-2 dosen
        foreach ($matakuliahs as $mk) {
            $n = min(rand(1, 2), $dosens->count());
            $randomDosens = $dosens->random($n);
            foreach ($randomDosens as $dosen) {
                Pengampu::firstOrCreate(
                    ['Kode_mk' => $mk->Kode_mk, 'NIP' => $dosen->NIP],
                    ['Kode_mk' => $mk->Kode_mk, 'NIP' => $dosen->NIP]
                );
            }
        }
    }
}
