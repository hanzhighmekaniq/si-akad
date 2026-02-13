<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JadwalAkademik;
use App\Models\PresensiAkademik;
use App\Models\Krs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresensiController extends Controller
{
    /**
     * Display a listing of jadwal for presensi.
     */
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        // Get today's day name in Indonesian
        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);

        // Get jadwal for today
        $jadwalHariIni = JadwalAkademik::whereHas('matakuliah.pengampu', function($query) use ($dosen) {
            $query->where('NIP', $dosen->NIP);
        })
        ->where('hari', $hariIni)
        ->with(['matakuliah', 'ruang', 'golongan'])
        ->orderBy('jam_mulai')
        ->get();

        // Get all jadwal (for other days)
        $semuaJadwal = JadwalAkademik::whereHas('matakuliah.pengampu', function($query) use ($dosen) {
            $query->where('NIP', $dosen->NIP);
        })
        ->with(['matakuliah', 'ruang', 'golongan'])
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get()
        ->groupBy('hari');

        return view('management.dosen.presensi.index', compact('dosen', 'jadwalHariIni', 'semuaJadwal', 'hariIni', 'today'));
    }

    /**
     * Show the form for creating presensi.
     */
    public function create(string $id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        $jadwal = JadwalAkademik::with(['matakuliah', 'ruang', 'golongan'])->findOrFail($id);

        // Verify that this dosen teaches this course
        $isPengampu = $jadwal->matakuliah->pengampu()
            ->where('NIP', $dosen->NIP)
            ->exists();

        if (!$isPengampu) {
            return redirect()->route('dosen.presensi.index')
                ->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        // Get mahasiswa list from KRS
        $mahasiswaList = Krs::where('Kode_mk', $jadwal->Kode_mk)
            ->where('id_Gol', $jadwal->id_Gol)
            ->with('mahasiswa')
            ->get()
            ->pluck('mahasiswa')
            ->filter();

        // Get today's date
        $today = Carbon::now()->format('Y-m-d');

        // Check if presensi already exists for today
        $existingPresensi = PresensiAkademik::where('Kode_mk', $jadwal->Kode_mk)
            ->where('hari', $jadwal->hari)
            ->where('tanggal', $today)
            ->pluck('NIM')
            ->toArray();

        return view('management.dosen.presensi.create', compact('dosen', 'jadwal', 'mahasiswaList', 'today', 'existingPresensi'));
    }

    /**
     * Store presensi data.
     */
    public function store(Request $request, string $id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        $jadwal = JadwalAkademik::with(['matakuliah'])->findOrFail($id);

        // Verify that this dosen teaches this course
        $isPengampu = $jadwal->matakuliah->pengampu()
            ->where('NIP', $dosen->NIP)
            ->exists();

        if (!$isPengampu) {
            return redirect()->route('dosen.presensi.index')
                ->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'presensi' => 'required|array',
            'presensi.*' => 'required|in:Hadir,Izin,Sakit,Alpa',
        ]);

        $tanggal = $request->tanggal;
        $presensiData = $request->presensi;

        // Delete existing presensi for this date if any
        PresensiAkademik::where('Kode_mk', $jadwal->Kode_mk)
            ->where('hari', $jadwal->hari)
            ->where('tanggal', $tanggal)
            ->delete();

        // Insert new presensi
        foreach ($presensiData as $nim => $status) {
            PresensiAkademik::create([
                'hari' => $jadwal->hari,
                'tanggal' => $tanggal,
                'status_kehadiran' => $status,
                'NIM' => $nim,
                'Kode_mk' => $jadwal->Kode_mk,
            ]);
        }

        return redirect()->route('dosen.presensi.show', $id)
            ->with('success', 'Presensi berhasil disimpan.');
    }

    /**
     * Display presensi report for a jadwal.
     */
    public function show(string $id)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        $jadwal = JadwalAkademik::with(['matakuliah', 'ruang', 'golongan'])->findOrFail($id);

        // Verify that this dosen teaches this course
        $isPengampu = $jadwal->matakuliah->pengampu()
            ->where('NIP', $dosen->NIP)
            ->exists();

        if (!$isPengampu) {
            return redirect()->route('dosen.presensi.index')
                ->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        // Get all presensi for this mata kuliah (all sessions)
        $presensiList = PresensiAkademik::where('Kode_mk', $jadwal->Kode_mk)
            ->where('hari', $jadwal->hari)
            ->with('mahasiswa')
            ->orderBy('tanggal', 'desc')
            ->get();

        // Group by tanggal
        $presensiPerTanggal = $presensiList->groupBy('tanggal');

        // Get mahasiswa list from KRS
        $mahasiswaList = Krs::where('Kode_mk', $jadwal->Kode_mk)
            ->where('id_Gol', $jadwal->id_Gol)
            ->with('mahasiswa')
            ->get()
            ->pluck('mahasiswa')
            ->filter();

        // Calculate statistics per mahasiswa
        $statistik = [];
        foreach ($mahasiswaList as $mhs) {
            $totalPertemuan = $presensiPerTanggal->count();
            $presensiMhs = $presensiList->where('NIM', $mhs->NIM);

            $hadir = $presensiMhs->where('status_kehadiran', 'Hadir')->count();
            $izin = $presensiMhs->where('status_kehadiran', 'Izin')->count();
            $sakit = $presensiMhs->where('status_kehadiran', 'Sakit')->count();
            $alpa = $presensiMhs->where('status_kehadiran', 'Alpa')->count();

            $persentase = $totalPertemuan > 0 ? ($hadir / $totalPertemuan) * 100 : 0;

            $statistik[$mhs->NIM] = [
                'mahasiswa' => $mhs,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpa' => $alpa,
                'total' => $totalPertemuan,
                'persentase' => round($persentase, 1),
            ];
        }

        return view('management.dosen.presensi.show', compact('dosen', 'jadwal', 'presensiPerTanggal', 'statistik'));
    }

    /**
     * Get Indonesian day name from day of week number.
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

        return $days[$dayOfWeek] ?? 'Senin';
    }
}
