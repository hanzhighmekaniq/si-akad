<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Pengampu;
use App\Models\JadwalAkademik;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return view('management.dosen.dashboard', [
                'dosen' => null,
                'matakuliah' => collect(),
                'jadwalMengajar' => collect(),
            ]);
        }

        $matakuliah = Pengampu::where('NIP', $dosen->NIP)
            ->with('matakuliah')
            ->get();

        $jadwalMengajar = JadwalAkademik::whereHas('matakuliah.pengampu', function ($query) use ($dosen) {
            $query->where('NIP', $dosen->NIP);
        })
            ->with(['matakuliah', 'ruang', 'golongan'])
            ->get();

        return view('management.dosen.dashboard', [
            'dosen' => $dosen,
            'matakuliah' => $matakuliah,
            'jadwalMengajar' => $jadwalMengajar,
        ]);
    }
}
