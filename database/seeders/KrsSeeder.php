<?php

namespace Database\Seeders;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\JadwalAkademik;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mhs) {
            // Get jadwal for this mahasiswa's golongan
            $jadwals = JadwalAkademik::where('id_Gol', $mhs->id_Gol)->get();

            // Each mahasiswa takes 4-6 matakuliah from their golongan's jadwal
            $mkCount = min(rand(4, 6), $jadwals->count());
            $selectedJadwals = $jadwals->random($mkCount);

            foreach ($selectedJadwals as $jadwal) {
                Krs::create([
                    'NIM' => $mhs->NIM,
                    'Kode_mk' => $jadwal->Kode_mk,
                ]);
            }
        }
    }
}
