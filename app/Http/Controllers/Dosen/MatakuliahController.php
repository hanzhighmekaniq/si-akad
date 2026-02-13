<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Pengampu;
use App\Models\JadwalAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        $matakuliah = Pengampu::where('NIP', $dosen->NIP)
            ->with(['matakuliah'])
            ->get();

        return view('management.dosen.matakuliah.index', compact('dosen', 'matakuliah'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_mk)
    {
        $dosen = Dosen::where('user_id', Auth::id())->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan.');
        }

        // Verify that this dosen teaches this course
        $pengampu = Pengampu::where('NIP', $dosen->NIP)
            ->where('Kode_mk', $kode_mk)
            ->first();

        if (!$pengampu) {
            return redirect()->route('dosen.matakuliah.index')
                ->with('error', 'Anda tidak mengampu mata kuliah ini.');
        }

        $matakuliah = Matakuliah::where('Kode_mk', $kode_mk)->firstOrFail();

        // Get jadwal for this mata kuliah
        $jadwal = JadwalAkademik::where('Kode_mk', $kode_mk)
            ->with(['golongan', 'ruang'])
            ->get();

        // Get all classes (golongan) that take this course
        $kelasCount = $jadwal->unique('id_Gol')->count();

        // Get total students taking this course
        $studentCount = \App\Models\Krs::where('Kode_mk', $kode_mk)->count();

        return view('management.dosen.matakuliah.show', compact('dosen', 'matakuliah', 'jadwal', 'kelasCount', 'studentCount'));
    }
}
