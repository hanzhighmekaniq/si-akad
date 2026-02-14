<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\JadwalAkademik;

class JadwalController extends Controller
{
    /**
     * Display jadwal kuliah mahasiswa
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil jadwal berdasarkan golongan mahasiswa
        $jadwalKuliah = JadwalAkademik::where('id_Gol', $mahasiswa->id_Gol)
            ->with(['matakuliah.pengampu.dosen', 'ruang', 'golongan'])
            ->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        // Kelompokkan jadwal per hari
        $jadwalPerHari = $jadwalKuliah->groupBy('hari');

        // Daftar hari
        $daftarHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('management.mahasiswa.jadwal.index', [
            'mahasiswa' => $mahasiswa,
            'jadwalKuliah' => $jadwalKuliah,
            'jadwalPerHari' => $jadwalPerHari,
            'daftarHari' => $daftarHari,
        ]);
    }
}
