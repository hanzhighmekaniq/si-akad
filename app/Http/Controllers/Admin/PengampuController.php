<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Pengampu;
use Illuminate\Http\Request;

class PengampuController extends Controller
{
    /**
     * Daftar pengampu per dosen (satu baris per dosen).
     */
    public function index(Request $request)
    {
        $query = Dosen::withCount('pengampu')->orderBy('Nama');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('Nama', 'like', "%{$search}%")
                    ->orWhere('NIP', 'like', "%{$search}%");
            });
        }

        $dosen = $query->paginate(10);
        $dosenList = Dosen::orderBy('Nama')->get();

        return view('management.admin.pengampu.index', compact('dosen', 'dosenList'));
    }

    /**
     * Tampilkan detail dosen dan daftar mata kuliah yang diampu.
     */
    public function show(string $nip)
    {
        $dosen = Dosen::where('NIP', $nip)->firstOrFail();
        $dosen->load(['pengampu.matakuliah']);

        return view('management.admin.pengampu.show', compact('dosen'));
    }

    /**
     * Form tambah pengampu: pilih dosen lalu pilih matakuliah.
     */
    public function create(Request $request)
    {
        $dosenList = Dosen::with('user')->orderBy('Nama')->get();
        $matakuliahList = Matakuliah::orderBy('semester')->orderBy('Kode_mk')->get();
        $selectedNip = $request->old('NIP');

        return view('management.admin.pengampu.create', compact('dosenList', 'matakuliahList', 'selectedNip'));
    }

    /**
     * Simpan pengampu: satu dosen bisa banyak matakuliah.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIP' => ['required', 'string', 'exists:dosen,NIP'],
            'Kode_mk' => ['required', 'array', 'min:1'],
            'Kode_mk.*' => ['required', 'string', 'exists:matakuliah,Kode_mk'],
        ], [
            'NIP.required' => 'Pilih dosen.',
            'NIP.exists' => 'Dosen tidak valid.',
            'Kode_mk.required' => 'Pilih minimal satu mata kuliah.',
            'Kode_mk.*.exists' => 'Mata kuliah tidak valid.',
        ]);

        $added = 0;
        foreach ($validated['Kode_mk'] as $kode_mk) {
            $exists = Pengampu::where('NIP', $validated['NIP'])->where('Kode_mk', $kode_mk)->exists();
            if (!$exists) {
                Pengampu::create(['NIP' => $validated['NIP'], 'Kode_mk' => $kode_mk]);
                $added++;
            }
        }

        $msg = $added > 0
            ? "Pengampu berhasil ditambahkan ({$added} mata kuliah)."
            : "Dosen sudah mengampu mata kuliah yang dipilih.";
        return redirect()->route('admin.pengampu.index')->with('success', $msg);
    }

    /**
     * Form edit pengampu: ubah daftar mata kuliah yang diampu dosen.
     */
    public function edit(string $nip)
    {
        $dosen = Dosen::where('NIP', $nip)->firstOrFail();
        $matakuliahList = Matakuliah::orderBy('semester')->orderBy('Kode_mk')->get();
        $currentKodeMk = Pengampu::where('NIP', $nip)->pluck('Kode_mk')->toArray();

        return view('management.admin.pengampu.edit', compact('dosen', 'matakuliahList', 'currentKodeMk'));
    }

    /**
     * Update pengampu: sinkron daftar mata kuliah untuk dosen ini.
     */
    public function update(Request $request, string $nip)
    {
        $dosen = Dosen::where('NIP', $nip)->firstOrFail();

        $validated = $request->validate([
            'Kode_mk' => ['nullable', 'array'],
            'Kode_mk.*' => ['required', 'string', 'exists:matakuliah,Kode_mk'],
        ], [
            'Kode_mk.*.exists' => 'Mata kuliah tidak valid.',
        ]);

        $selected = $validated['Kode_mk'] ?? [];

        Pengampu::where('NIP', $nip)->whereNotIn('Kode_mk', $selected)->delete();

        foreach ($selected as $kode_mk) {
            Pengampu::firstOrCreate(['NIP' => $nip, 'Kode_mk' => $kode_mk], ['NIP' => $nip, 'Kode_mk' => $kode_mk]);
        }

        return redirect()->route('admin.pengampu.index')->with('success', 'Pengampu untuk ' . $dosen->Nama . ' berhasil diperbarui.');
    }

    /**
     * Hapus satu pengampu (NIP + Kode_mk).
     */
    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'NIP' => ['required', 'string', 'exists:dosen,NIP'],
            'Kode_mk' => ['required', 'string', 'exists:matakuliah,Kode_mk'],
        ]);

        Pengampu::where('NIP', $validated['NIP'])->where('Kode_mk', $validated['Kode_mk'])->delete();

        return redirect()->route('admin.pengampu.index')->with('success', 'Pengampu berhasil dihapus.');
    }
}
