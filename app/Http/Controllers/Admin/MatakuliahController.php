<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Matakuliah::query();

        // Search by kode or nama matakuliah
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('Kode_mk', 'like', '%' . $request->search . '%')
                  ->orWhere('Nama_mk', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by semester
        if ($request->has('semester') && $request->semester != '') {
            $query->where('semester', $request->semester);
        }

        // Filter by SKS
        if ($request->has('sks') && $request->sks != '') {
            $query->where('sks', $request->sks);
        }

        $matakuliah = $query->orderBy('semester')->orderBy('Kode_mk')->paginate(10);

        return view('management.admin.matakuliah.index', compact('matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.admin.matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Kode_mk' => ['required', 'string', 'max:255', 'unique:matakuliah,Kode_mk'],
            'Nama_mk' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
        ], [
            'Kode_mk.required' => 'Kode mata kuliah wajib diisi',
            'Kode_mk.unique' => 'Kode mata kuliah sudah ada',
            'Nama_mk.required' => 'Nama mata kuliah wajib diisi',
            'sks.required' => 'SKS wajib diisi',
            'sks.min' => 'SKS minimal 1',
            'sks.max' => 'SKS maksimal 6',
            'semester.required' => 'Semester wajib diisi',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 8',
        ]);

        Matakuliah::create($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        return view('management.admin.matakuliah.show', compact('matakuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);
        return view('management.admin.matakuliah.edit', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);

        $validated = $request->validate([
            'Kode_mk' => ['required', 'string', 'max:255', 'unique:matakuliah,Kode_mk,' . $kode_mk . ',Kode_mk'],
            'Nama_mk' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'],
        ], [
            'Kode_mk.required' => 'Kode mata kuliah wajib diisi',
            'Kode_mk.unique' => 'Kode mata kuliah sudah ada',
            'Nama_mk.required' => 'Nama mata kuliah wajib diisi',
            'sks.required' => 'SKS wajib diisi',
            'sks.min' => 'SKS minimal 1',
            'sks.max' => 'SKS maksimal 6',
            'semester.required' => 'Semester wajib diisi',
            'semester.min' => 'Semester minimal 1',
            'semester.max' => 'Semester maksimal 8',
        ]);

        $matakuliah->update($validated);

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kode_mk)
    {
        $matakuliah = Matakuliah::findOrFail($kode_mk);

        // Check if matakuliah is being used
        if ($matakuliah->pengampu()->count() > 0) {
            return redirect()->route('admin.matakuliah.index')
                ->with('error', 'Mata kuliah tidak dapat dihapus karena masih memiliki data pengampu!');
        }

        if ($matakuliah->krs()->count() > 0) {
            return redirect()->route('admin.matakuliah.index')
                ->with('error', 'Mata kuliah tidak dapat dihapus karena masih digunakan dalam KRS!');
        }

        $matakuliah->delete();

        return redirect()->route('admin.matakuliah.index')
            ->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
