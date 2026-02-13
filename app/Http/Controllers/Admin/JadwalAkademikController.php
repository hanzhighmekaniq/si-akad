<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalAkademik;
use App\Models\Matakuliah;
use App\Models\Ruang;
use App\Models\Golongan;
use Illuminate\Http\Request;

class JadwalAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JadwalAkademik::with(['matakuliah', 'ruang', 'golongan']);

        // Filter by hari
        if ($request->has('hari') && $request->hari != '') {
            $query->where('hari', $request->hari);
        }

        // Filter by golongan
        if ($request->has('id_Gol') && $request->id_Gol != '') {
            $query->where('id_Gol', $request->id_Gol);
        }

        // Search by mata kuliah or ruang
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->whereHas('matakuliah', function($q) use ($request) {
                    $q->where('Nama_mk', 'like', '%' . $request->search . '%')
                      ->orWhere('Kode_mk', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('ruang', function($q) use ($request) {
                    $q->where('nama_ruang', 'like', '%' . $request->search . '%');
                });
            });
        }

        $jadwal = $query->latest()->paginate(10);
        $golongans = Golongan::all();

        return view('management.admin.jadwal.index', compact('jadwal', 'golongans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matakuliahs = Matakuliah::orderBy('semester')->orderBy('Nama_mk')->get();
        $ruangs = Ruang::orderBy('nama_ruang')->get();
        $golongans = Golongan::orderBy('nama_Gol')->get();

        return view('management.admin.jadwal.create', compact('matakuliahs', 'ruangs', 'golongans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'Kode_mk' => ['required', 'exists:matakuliah,Kode_mk'],
            'id_ruang' => ['required', 'exists:ruang,id_ruang'],
            'id_Gol' => ['required', 'exists:golongan,id_Gol'],
        ], [
            'hari.required' => 'Hari wajib diisi',
            'hari.in' => 'Hari tidak valid',
            'Kode_mk.required' => 'Mata kuliah wajib dipilih',
            'Kode_mk.exists' => 'Mata kuliah tidak ditemukan',
            'id_ruang.required' => 'Ruangan wajib dipilih',
            'id_ruang.exists' => 'Ruangan tidak ditemukan',
            'id_Gol.required' => 'Golongan wajib dipilih',
            'id_Gol.exists' => 'Golongan tidak ditemukan',
        ]);

        // Check for conflicts - same ruang, same hari
        $conflict = JadwalAkademik::where('hari', $validated['hari'])
            ->where('id_ruang', $validated['id_ruang'])
            ->exists();

        if ($conflict) {
            return back()->withInput()->withErrors([
                'conflict' => 'Ruangan sudah digunakan pada hari yang sama!'
            ]);
        }

        JadwalAkademik::create($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal akademik berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalAkademik $jadwal)
    {
        $jadwal->load(['matakuliah', 'ruang', 'golongan']);
        return view('management.admin.jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalAkademik $jadwal)
    {
        $matakuliahs = Matakuliah::orderBy('semester')->orderBy('Nama_mk')->get();
        $ruangs = Ruang::orderBy('nama_ruang')->get();
        $golongans = Golongan::orderBy('nama_Gol')->get();

        return view('management.admin.jadwal.edit', compact('jadwal', 'matakuliahs', 'ruangs', 'golongans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalAkademik $jadwal)
    {
        $validated = $request->validate([
            'hari' => ['required', 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu'],
            'Kode_mk' => ['required', 'exists:matakuliah,Kode_mk'],
            'id_ruang' => ['required', 'exists:ruang,id_ruang'],
            'id_Gol' => ['required', 'exists:golongan,id_Gol'],
        ], [
            'hari.required' => 'Hari wajib diisi',
            'hari.in' => 'Hari tidak valid',
            'Kode_mk.required' => 'Mata kuliah wajib dipilih',
            'Kode_mk.exists' => 'Mata kuliah tidak ditemukan',
            'id_ruang.required' => 'Ruangan wajib dipilih',
            'id_ruang.exists' => 'Ruangan tidak ditemukan',
            'id_Gol.required' => 'Golongan wajib dipilih',
            'id_Gol.exists' => 'Golongan tidak ditemukan',
        ]);

        // Check for conflicts - same ruang, same hari (excluding current jadwal)
        $conflict = JadwalAkademik::where('hari', $validated['hari'])
            ->where('id_ruang', $validated['id_ruang'])
            ->where('id', '!=', $jadwal->id)
            ->exists();

        if ($conflict) {
            return back()->withInput()->withErrors([
                'conflict' => 'Ruangan sudah digunakan pada hari yang sama!'
            ]);
        }

        $jadwal->update($validated);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal akademik berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalAkademik $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal akademik berhasil dihapus!');
    }
}
