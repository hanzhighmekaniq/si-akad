<?php

namespace Database\Seeders;

use App\Models\JadwalAkademik;
use App\Models\Matakuliah;
use App\Models\Ruang;
use App\Models\Golongan;
use Illuminate\Database\Seeder;

class JadwalAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matakuliahs = Matakuliah::all();
        $ruangs = Ruang::all();
        $golongans = Golongan::all();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        // Possible time slots (jam_mulai)
        $timeSlots = [
            ['07:00:00', '09:30:00'],
            ['09:40:00', '12:10:00'],
            ['13:00:00', '15:30:00'],
            ['15:40:00', '18:10:00'],
        ];

        // Create jadwal for each golongan
        foreach ($golongans as $gol) {
            $usedMatakuliah = [];

            // Each golongan gets 5-8 matakuliah
            $mkCount = rand(5, 8);
            $availableMk = $matakuliahs->shuffle();

            $availableMk = $availableMk->values();
            for ($i = 0; $i < $mkCount && $i < $availableMk->count(); $i++) {
                $mk = $availableMk[$i];
                $timeSlot = $timeSlots[array_rand($timeSlots)];
                $hari = $hariList[array_rand($hariList)];

                JadwalAkademik::firstOrCreate(
                    [
                        'Kode_mk' => $mk->Kode_mk,
                        'id_Gol' => $gol->id_Gol,
                        'hari' => $hari,
                    ],
                    [
                        'hari' => $hari,
                        'jam_mulai' => $timeSlot[0],
                        'jam_selesai' => $timeSlot[1],
                        'Kode_mk' => $mk->Kode_mk,
                        'id_ruang' => $ruangs->random()->id_ruang,
                        'id_Gol' => $gol->id_Gol,
                    ]
                );
            }
        }
    }
}
