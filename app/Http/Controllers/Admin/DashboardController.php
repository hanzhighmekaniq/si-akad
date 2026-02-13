<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Ruang;
use App\Models\Golongan;
use App\Models\JadwalAkademik;
use App\Models\Krs;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalMahasiswa' => Mahasiswa::count(),
            'totalDosen' => Dosen::count(),
            'totalMatakuliah' => Matakuliah::count(),
            'totalRuang' => Ruang::count(),
            'totalGolongan' => Golongan::count(),
            'totalJadwal' => JadwalAkademik::count(),
            'totalKrs' => Krs::count(),
        ]);
    }
}
