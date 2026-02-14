<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\JadwalAkademik;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    private function getDayName(int $dayOfWeek): string
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

    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return view('management.dosen.dashboard', [
                'dosen' => null,
                'matakuliah' => collect(),
                'jadwalMengajar' => collect(),
                'jadwalHariIni' => collect(),
                'jadwalBesok' => collect(),
                'jadwalMingguIni' => collect(),
                'hariIni' => $this->getDayName(Carbon::now()->dayOfWeek),
                'besok' => $this->getDayName(Carbon::now()->addDay()->dayOfWeek),
                'today' => Carbon::now(),
            ]);
        }

        $matakuliah = Pengampu::where('NIP', $dosen->NIP)
            ->with('matakuliah')
            ->get();

        $jadwalMengajar = JadwalAkademik::whereHas('matakuliah.pengampu', function ($query) use ($dosen) {
            $query->where('NIP', $dosen->NIP);
        })
            ->with(['matakuliah', 'ruang', 'golongan'])
            ->orderBy('jam_mulai')
            ->get();

        $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $jadwalMengajar = $jadwalMengajar->sortBy(function ($j) use ($hariUrutan) {
            $i = array_search($j->hari, $hariUrutan);
            return ($i === false ? 99 : $i) * 1000 . $j->jam_mulai;
        })->values();

        $today = Carbon::now();
        $hariIni = $this->getDayName($today->dayOfWeek);
        $besok = $this->getDayName($today->copy()->addDay()->dayOfWeek);

        $jadwalHariIni = $jadwalMengajar->where('hari', $hariIni)->values();
        $jadwalBesok = $jadwalMengajar->where('hari', $besok)->values();

        // Jadwal minggu ini: dikelompokkan per hari untuk filter cepat
        $jadwalMingguIni = $jadwalMengajar->groupBy('hari')->sortBy(function ($_, $key) use ($hariUrutan) {
            $i = array_search($key, $hariUrutan);
            return $i === false ? 99 : $i;
        });

        return view('management.dosen.dashboard', [
            'dosen' => $dosen,
            'matakuliah' => $matakuliah,
            'jadwalMengajar' => $jadwalMengajar,
            'jadwalHariIni' => $jadwalHariIni,
            'jadwalBesok' => $jadwalBesok,
            'jadwalMingguIni' => $jadwalMingguIni,
            'hariIni' => $hariIni,
            'besok' => $besok,
            'today' => $today,
        ]);
    }
}
