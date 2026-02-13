<?php

namespace Database\Seeders;

use App\Models\PresensiAkademik;
use App\Models\Krs;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PresensiAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $krsList = Krs::all();
        $statusList = ['Hadir', 'Izin', 'Sakit', 'Alpa'];
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        foreach ($krsList as $krs) {
            // Create 8-12 presensi records for each KRS (simulating semester attendance)
            $presensiCount = rand(8, 12);

            for ($i = 0; $i < $presensiCount; $i++) {
                $tanggal = Carbon::now()->subDays(rand(1, 90));

                PresensiAkademik::create([
                    'hari' => $hariList[array_rand($hariList)],
                    'tanggal' => $tanggal,
                    'status_kehadiran' => $statusList[array_rand($statusList)],
                    'NIM' => $krs->NIM,
                    'Kode_mk' => $krs->Kode_mk,
                ]);
            }
        }
    }
}
