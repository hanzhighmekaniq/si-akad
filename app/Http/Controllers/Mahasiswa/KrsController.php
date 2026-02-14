<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Krs;

class KrsController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.');
        }

        $krs = Krs::where('NIM', $mahasiswa->NIM)
            ->with(['matakuliah.pengampu.dosen'])
            ->get();

        // Calculate total SKS
        $totalSks = $krs->sum(function ($item) {
            return $item->matakuliah->sks ?? 0;
        });

        // Group by semester if matakuliah has semester field
        $krsBySemester = $krs->groupBy(function ($item) {
            return $item->matakuliah->Semester ?? 'Tidak Diketahui';
        });

        return view('management.mahasiswa.krs.index', [
            'mahasiswa' => $mahasiswa,
            'krs' => $krs,
            'totalSks' => $totalSks,
            'krsBySemester' => $krsBySemester,
        ]);
    }
}
