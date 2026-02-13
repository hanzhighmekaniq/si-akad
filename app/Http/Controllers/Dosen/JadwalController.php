<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\JadwalAkademik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JadwalController extends Controller
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

        // Get jadwal mengajar for this dosen
        $jadwalMengajar = JadwalAkademik::whereHas('matakuliah.pengampu', function($query) use ($dosen) {
            $query->where('NIP', $dosen->NIP);
        })
        ->with(['matakuliah', 'ruang', 'golongan'])
        ->orderBy('hari')
        ->orderBy('jam_mulai')
        ->get();

        // Group by day for better display
        $jadwalPerHari = $jadwalMengajar->groupBy('hari');

        // Get statistics
        $totalJadwal = $jadwalMengajar->count();
        $totalKelas = $jadwalMengajar->unique('id_Gol')->count();
        $totalMatakuliah = $jadwalMengajar->unique('Kode_mk')->count();

        return view('management.dosen.jadwal.index', compact('dosen', 'jadwalMengajar', 'jadwalPerHari', 'totalJadwal', 'totalKelas', 'totalMatakuliah'));
    }

    /**
     * Display the specified resource.
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
            return redirect()->route('dosen.jadwal.index')
                ->with('error', 'Anda tidak mengampu jadwal ini.');
        }

        // Get students taking this course in this class
        $mahasiswa = \App\Models\Krs::where('Kode_mk', $jadwal->Kode_mk)
            ->whereHas('mahasiswa', function($query) use ($jadwal) {
                $query->where('id_Gol', $jadwal->id_Gol);
            })
            ->with('mahasiswa')
            ->get();

        return view('management.dosen.jadwal.show', compact('dosen', 'jadwal', 'mahasiswa'));
    }
}
