<?php

namespace Database\Seeders;

use App\Models\PresensiAkademik;
use App\Models\Krs;
use App\Models\JadwalAkademik;
use App\Models\Mahasiswa;
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

        // ============================================
        // 1. HISTORICAL ATTENDANCE DATA (Past 60 days)
        // ============================================
        echo "Creating historical attendance data...\n";
        
        foreach ($krsList as $krs) {
            $presensiCount = rand(8, 12);
            for ($i = 0; $i < $presensiCount; $i++) {
                $tanggal = Carbon::now()->subDays(rand(7, 60));
                $dayOfWeek = $tanggal->dayOfWeek;
                $hariIndonesia = $this->getDayName($dayOfWeek);
                $tglStr = $tanggal->format('Y-m-d');
                PresensiAkademik::firstOrCreate(
                    ['NIM' => $krs->NIM, 'Kode_mk' => $krs->Kode_mk, 'tanggal' => $tglStr],
                    [
                        'hari' => $hariIndonesia,
                        'tanggal' => $tglStr,
                        'status_kehadiran' => $statusList[array_rand($statusList)],
                        'NIM' => $krs->NIM,
                        'Kode_mk' => $krs->Kode_mk,
                    ]
                );
            }
        }

        // ============================================
        // 2. TODAY'S ATTENDANCE DATA (Partial)
        // ============================================
        echo "\n";
        echo "============================================\n";
        echo "Creating today's attendance data (some students have checked in, some haven't)...\n";
        echo "============================================\n";
        
        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);
        
        // Get all schedules for today
        $jadwalHariIni = JadwalAkademik::where('hari', $hariIni)
            ->with(['matakuliah', 'golongan'])
            ->get();

        if ($jadwalHariIni->count() > 0) {
            echo "✅ Found {$jadwalHariIni->count()} classes scheduled for today ({$hariIni})\n\n";

            foreach ($jadwalHariIni as $jadwal) {
                // Get all students in this golongan
                $mahasiswaList = Mahasiswa::where('id_Gol', $jadwal->id_Gol)->get();
                
                if ($mahasiswaList->count() > 0) {
                    echo "  - {$jadwal->matakuliah->Nama_mk} ({$jadwal->golongan->nama_Gol}): ";
                    
                    // Only 60-80% of students have checked in (simulating realistic scenario)
                    $checkInRate = rand(60, 80);
                    $totalStudents = $mahasiswaList->count();
                    $studentsCheckedIn = (int) ceil($totalStudents * ($checkInRate / 100));
                    
                    // Randomly select which students have checked in
                    $checkedInStudents = $mahasiswaList->random($studentsCheckedIn);
                    
                    foreach ($checkedInStudents as $mahasiswa) {
                        // Check if student is enrolled in this course
                        $isEnrolled = Krs::where('NIM', $mahasiswa->NIM)
                            ->where('Kode_mk', $jadwal->Kode_mk)
                            ->exists();
                        
                        if ($isEnrolled) {
                            $rand = rand(1, 100);
                            if ($rand <= 90) {
                                $status = 'Hadir';
                            } elseif ($rand <= 95) {
                                $status = 'Izin';
                            } else {
                                $status = 'Sakit';
                            }
                            $tglStr = $today->format('Y-m-d');
                            PresensiAkademik::firstOrCreate(
                                ['NIM' => $mahasiswa->NIM, 'Kode_mk' => $jadwal->Kode_mk, 'tanggal' => $tglStr],
                                [
                                    'hari' => $hariIni,
                                    'tanggal' => $tglStr,
                                    'status_kehadiran' => $status,
                                    'NIM' => $mahasiswa->NIM,
                                    'Kode_mk' => $jadwal->Kode_mk,
                                ]
                            );
                        }
                    }
                    
                    $notCheckedIn = $totalStudents - $studentsCheckedIn;
                    echo "   ✓ {$studentsCheckedIn}/{$totalStudents} students checked in ({$notCheckedIn} NOT checked in yet)\n";
                }
            }

            echo "\n";
            echo "============================================\n";
            echo "✅ Seeder completed!\n";
            echo "============================================\n";
            echo "📝 Summary: Some students have already checked in today, others haven't.\n";
            echo "🎯 Students who haven't checked in can now test the check-in feature!\n";
            echo "\n";
            echo "📌 Test Account: mahasiswa1@siakad.com / password\n";
            echo "============================================\n";
        } else {
            echo "\n";
            echo "============================================\n";
            echo "⚠️  WARNING: No classes scheduled for today ({$hariIni}).\n";
            echo "============================================\n";
            echo "💡 Fix: Update some jadwal to today's schedule\n";
            echo "   UPDATE jadwal_akademik SET hari = '{$hariIni}' WHERE id <= 5;\n";
            echo "============================================\n";
        }

        // ============================================
        // 3. YESTERDAY'S ATTENDANCE (Most complete)
        // ============================================
        echo "\nCreating yesterday's attendance data (mostly complete)...\n";
        
        $yesterday = Carbon::yesterday();
        $hariKemarin = $this->getDayName($yesterday->dayOfWeek);
        
        $jadwalKemarin = JadwalAkademik::where('hari', $hariKemarin)->with('matakuliah')->get();
        
        if ($jadwalKemarin->count() > 0) {
            foreach ($jadwalKemarin as $jadwal) {
                $mahasiswaList = Mahasiswa::where('id_Gol', $jadwal->id_Gol)->get();
                
                // Yesterday: 85-95% attendance (more complete)
                $studentsToMark = (int) ceil($mahasiswaList->count() * (rand(85, 95) / 100));
                $selectedStudents = $mahasiswaList->random(min($studentsToMark, $mahasiswaList->count()));
                
                foreach ($selectedStudents as $mahasiswa) {
                    $isEnrolled = Krs::where('NIM', $mahasiswa->NIM)
                        ->where('Kode_mk', $jadwal->Kode_mk)
                        ->exists();
                    if ($isEnrolled) {
                        $tglStr = $yesterday->format('Y-m-d');
                        PresensiAkademik::firstOrCreate(
                            ['NIM' => $mahasiswa->NIM, 'Kode_mk' => $jadwal->Kode_mk, 'tanggal' => $tglStr],
                            [
                                'hari' => $hariKemarin,
                                'tanggal' => $tglStr,
                                'status_kehadiran' => $statusList[array_rand($statusList)],
                                'NIM' => $mahasiswa->NIM,
                                'Kode_mk' => $jadwal->Kode_mk,
                            ]
                        );
                    }
                }
            }
        }
    }

    /**
     * Get Indonesian day name from day of week number
     */
    private function getDayName($dayOfWeek)
    {
        $days = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        return $days[$dayOfWeek];
    }
}
