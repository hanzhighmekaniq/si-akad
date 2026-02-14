<?php

namespace Database\Seeders;

use App\Models\JadwalAkademik;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetupTodayScheduleSeeder extends Seeder
{
    /**
     * Setup schedules for today to make testing easier
     */
    public function run(): void
    {
        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);
        
        echo "\n";
        echo "============================================\n";
        echo "🔧 SETUP TODAY'S SCHEDULE FOR TESTING\n";
        echo "============================================\n";
        echo "Today: {$today->format('Y-m-d')} ({$hariIni})\n";
        echo "Current Time: {$today->format('H:i:s')}\n";
        echo "\n";
        
        // Get mahasiswa1's golongan
        $mahasiswa = Mahasiswa::whereHas('user', function($q) {
            $q->where('email', 'mahasiswa1@siakad.com');
        })->first();
        
        if (!$mahasiswa) {
            echo "⚠️  mahasiswa1@siakad.com not found!\n";
            echo "Run: php artisan migrate:fresh --seed\n";
            return;
        }
        
        $golonganId = $mahasiswa->id_Gol;
        echo "Target Golongan: {$mahasiswa->golongan->nama_Gol} (ID: {$golonganId})\n";
        echo "\n";
        
        // Get existing schedules for this golongan
        $existingSchedules = JadwalAkademik::where('id_Gol', $golonganId)->get();
        
        if ($existingSchedules->count() == 0) {
            echo "❌ No schedules found for this golongan!\n";
            echo "Run: php artisan db:seed --class=JadwalAkademikSeeder\n";
            return;
        }
        
        // Update first 3-5 schedules to today
        $scheduleCount = min(rand(3, 5), $existingSchedules->count());
        $schedulesToUpdate = $existingSchedules->take($scheduleCount);
        
        echo "Updating {$scheduleCount} schedules to today ({$hariIni})...\n";
        echo "--------------------------------------------\n";
        
        // Time slots for today (spread throughout the day)
        $timeSlots = [
            ['08:00:00', '10:30:00'],
            ['10:40:00', '13:10:00'],
            ['13:30:00', '16:00:00'],
            ['16:10:00', '18:40:00'],
        ];
        
        $currentTime = Carbon::now();
        
        foreach ($schedulesToUpdate as $index => $jadwal) {
            $timeSlot = $timeSlots[$index % count($timeSlots)];
            
            // Update to today
            $jadwal->update([
                'hari' => $hariIni,
                'jam_mulai' => $timeSlot[0],
                'jam_selesai' => $timeSlot[1],
            ]);
            
            $jamMulai = Carbon::parse($timeSlot[0]);
            $jamSelesai = Carbon::parse($timeSlot[1]);
            $allowFrom = $jamMulai->copy()->subMinutes(30);
            
            $canCheckIn = $currentTime->between($allowFrom, $jamSelesai);
            $status = $canCheckIn ? '✅ CAN CHECK IN NOW' : '⏰ Check-in later';
            
            echo ($index + 1) . ". {$jadwal->matakuliah->Nama_mk}\n";
            echo "   Time: {$timeSlot[0]} - {$timeSlot[1]}\n";
            echo "   Room: {$jadwal->ruang->nama_ruang}\n";
            echo "   Status: {$status}\n\n";
        }
        
        echo "============================================\n";
        echo "✅ Setup completed!\n";
        echo "============================================\n";
        echo "\n";
        echo "🧪 Login dan uji presensi:\n";
        echo "   Email: mahasiswa1@siakad.com\n";
        echo "   Password: password\n";
        echo "\n";
        echo "2. Buka presensi mahasiswa:\n";
        echo "   URL: http://localhost/mahasiswa/presensi\n";
        echo "   Email: mahasiswa1@siakad.com\n";
        echo "   Password: password\n";
        echo "\n";
        echo "============================================\n\n";
    }

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
