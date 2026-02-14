<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\PresensiAkademik;
use App\Models\JadwalAkademik;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.');
        }

        // Get all presensi records
        $presensi = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->with('matakuliah')
            ->orderBy('tanggal', 'desc')
            ->orderBy('hari')
            ->get();

        // Group by month for better display
        $presensiByMonth = $presensi->groupBy(function($item) {
            return Carbon::parse($item->tanggal)->format('Y-m');
        });

        // Calculate statistics
        $totalPresensi = $presensi->count();
        $hadir = $presensi->where('status_kehadiran', 'Hadir')->count();
        $izin = $presensi->where('status_kehadiran', 'Izin')->count();
        $alpa = $presensi->where('status_kehadiran', 'Alpa')->count();

        // Calculate attendance percentage
        $persentaseKehadiran = $totalPresensi > 0 ? round(($hadir / $totalPresensi) * 100, 2) : 0;

        // Get today's schedule to check for pending attendance
        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);

        $jadwalHariIni = JadwalAkademik::where('id_Gol', $mahasiswa->id_Gol)
            ->where('hari', $hariIni)
            ->with(['matakuliah', 'ruang'])
            ->orderBy('jam_mulai')
            ->get();

        // Check which classes have attendance records for today
        $presensiHariIni = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->where('tanggal', $today->format('Y-m-d'))
            ->pluck('Kode_mk')
            ->toArray();

        // Filter classes that don't have attendance yet
        $belumAbsen = $jadwalHariIni->filter(function($jadwal) use ($presensiHariIni) {
            return !in_array($jadwal->Kode_mk, $presensiHariIni);
        });

        return view('management.mahasiswa.presensi.index', [
            'mahasiswa' => $mahasiswa,
            'presensi' => $presensi,
            'presensiByMonth' => $presensiByMonth,
            'totalPresensi' => $totalPresensi,
            'hadir' => $hadir,
            'izin' => $izin,
            'alpa' => $alpa,
            'persentaseKehadiran' => $persentaseKehadiran,
            'jadwalHariIni' => $jadwalHariIni,
            'belumAbsen' => $belumAbsen,
            'hariIni' => $hariIni,
        ]);
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

    /**
     * Show the form for creating attendance
     */
    public function create($jadwalId)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.');
        }

        // Get the schedule
        $jadwal = JadwalAkademik::with(['matakuliah', 'ruang', 'golongan'])
            ->where('id', $jadwalId)
            ->where('id_Gol', $mahasiswa->id_Gol)
            ->firstOrFail();

        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);

        // Check if the class is today
        if ($jadwal->hari !== $hariIni) {
            return redirect()->route('mahasiswa.presensi.index')
                ->with('error', 'Presensi hanya dapat dilakukan pada hari jadwal kuliah.');
        }

        // Check if already checked in today
        $existingPresensi = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->where('Kode_mk', $jadwal->Kode_mk)
            ->where('tanggal', $today->format('Y-m-d'))
            ->first();

        if ($existingPresensi) {
            return redirect()->route('mahasiswa.presensi.index')
                ->with('warning', 'Anda sudah melakukan presensi untuk mata kuliah ini hari ini.');
        }

        // Check if within time window (can check in 30 minutes before to 15 minutes after class starts)
        $jamMulai = Carbon::parse($jadwal->jam_mulai);
        $jamSelesai = Carbon::parse($jadwal->jam_selesai);
        $allowCheckInFrom = $jamMulai->copy()->subMinutes(30);
        $allowCheckInUntil = $jamSelesai->copy();

        $now = Carbon::now();
        $canCheckIn = $now->between($allowCheckInFrom, $allowCheckInUntil);

        return view('management.mahasiswa.presensi.create', [
            'mahasiswa' => $mahasiswa,
            'jadwal' => $jadwal,
            'today' => $today,
            'hariIni' => $hariIni,
            'canCheckIn' => $canCheckIn,
            'allowCheckInFrom' => $allowCheckInFrom,
            'allowCheckInUntil' => $allowCheckInUntil,
            'now' => $now,
        ]);
    }

    /**
     * Store attendance
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_akademik,id',
        ]);

        $jadwal = JadwalAkademik::findOrFail($request->jadwal_id);
        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);

        // Verify the class is today
        if ($jadwal->hari !== $hariIni) {
            return redirect()->route('mahasiswa.presensi.index')
                ->with('error', 'Presensi hanya dapat dilakukan pada hari jadwal kuliah.');
        }

        // Check if already checked in
        $existingPresensi = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->where('Kode_mk', $jadwal->Kode_mk)
            ->where('tanggal', $today->format('Y-m-d'))
            ->first();

        if ($existingPresensi) {
            return redirect()->route('mahasiswa.presensi.index')
                ->with('warning', 'Anda sudah melakukan presensi untuk mata kuliah ini hari ini.');
        }

        // Check time window
        $jamMulai = Carbon::parse($jadwal->jam_mulai);
        $jamSelesai = Carbon::parse($jadwal->jam_selesai);
        $allowCheckInFrom = $jamMulai->copy()->subMinutes(30);
        $allowCheckInUntil = $jamSelesai->copy();

        $now = Carbon::now();
        if (!$now->between($allowCheckInFrom, $allowCheckInUntil)) {
            return redirect()->route('mahasiswa.presensi.index')
                ->with('error', 'Presensi hanya dapat dilakukan 30 menit sebelum hingga akhir waktu perkuliahan.');
        }

        // Create attendance record
        PresensiAkademik::create([
            'hari' => $hariIni,
            'tanggal' => $today->format('Y-m-d'),
            'status_kehadiran' => 'Hadir',
            'NIM' => $mahasiswa->NIM,
            'Kode_mk' => $jadwal->Kode_mk,
        ]);

        return redirect()->route('mahasiswa.presensi.index')
            ->with('success', 'Presensi berhasil dicatat. Terima kasih!');
    }

    /**
     * Get count of pending attendance for today (for notification badge)
     */
    public static function getPendingAttendanceCount()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return 0;
        }

        $today = Carbon::now();
        $hariIni = (new self)->getDayName($today->dayOfWeek);

        // Get today's schedule
        $jadwalHariIni = JadwalAkademik::where('id_Gol', $mahasiswa->id_Gol)
            ->where('hari', $hariIni)
            ->pluck('Kode_mk')
            ->toArray();

        // Get attendance records for today
        $presensiHariIni = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->where('tanggal', $today->format('Y-m-d'))
            ->pluck('Kode_mk')
            ->toArray();

        // Count classes without attendance
        $belumAbsen = array_diff($jadwalHariIni, $presensiHariIni);

        return count($belumAbsen);
    }
}
