<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Krs;
use App\Models\JadwalAkademik;
use App\Models\PresensiAkademik;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.');
        }

        $krs = Krs::where('NIM', $mahasiswa->NIM)
            ->with('matakuliah')
            ->get();

        $jadwalKuliah = JadwalAkademik::where('id_Gol', $mahasiswa->id_Gol)
            ->with(['matakuliah', 'ruang'])
            ->get();

        $presensi = PresensiAkademik::where('NIM', $mahasiswa->NIM)
            ->with('matakuliah')
            ->latest()
            ->limit(10)
            ->get();

        return view('management.mahasiswa.dashboard', [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'jadwalKuliah' => $jadwalKuliah,
            'presensi' => $presensi,
        ]);
    }
}
