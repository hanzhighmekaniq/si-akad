<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Golongan::withCount(['mahasiswa', 'jadwalAkademik']);

        // Search by id_Gol or nama_Gol
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('id_Gol', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_Gol', 'like', '%' . $request->search . '%');
            });
        }

        $golongan = $query->orderBy('nama_Gol')->paginate(10);

        return view('management.admin.golongan.index', compact('golongan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.admin.golongan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_Gol' => ['required', 'string', 'max:255', 'unique:golongan,id_Gol'],
            'nama_Gol' => ['required', 'string', 'max:255'],
        ], [
            'id_Gol.required' => 'ID golongan wajib diisi',
            'id_Gol.unique' => 'ID golongan sudah digunakan',
            'nama_Gol.required' => 'Nama golongan wajib diisi',
        ]);

        Golongan::create($validated);

        return redirect()->route('admin.golongan.index')
            ->with('success', 'Golongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_Gol)
    {
        $golongan = Golongan::withCount(['mahasiswa', 'jadwalAkademik'])->findOrFail($id_Gol);
        return view('management.admin.golongan.show', compact('golongan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_Gol)
    {
        $golongan = Golongan::findOrFail($id_Gol);
        return view('management.admin.golongan.edit', compact('golongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_Gol)
    {
        $golongan = Golongan::findOrFail($id_Gol);

        $validated = $request->validate([
            'id_Gol' => ['required', 'string', 'max:255', 'unique:golongan,id_Gol,' . $id_Gol . ',id_Gol'],
            'nama_Gol' => ['required', 'string', 'max:255'],
        ], [
            'id_Gol.required' => 'ID golongan wajib diisi',
            'id_Gol.unique' => 'ID golongan sudah digunakan',
            'nama_Gol.required' => 'Nama golongan wajib diisi',
        ]);

        $golongan->update($validated);

        return redirect()->route('admin.golongan.index')
            ->with('success', 'Golongan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_Gol)
    {
        $golongan = Golongan::findOrFail($id_Gol);

        // Check if golongan is being used
        if ($golongan->mahasiswa()->count() > 0) {
            return redirect()->route('admin.golongan.index')
                ->with('error', 'Golongan tidak dapat dihapus karena masih memiliki mahasiswa!');
        }

        if ($golongan->jadwalAkademik()->count() > 0) {
            return redirect()->route('admin.golongan.index')
                ->with('error', 'Golongan tidak dapat dihapus karena masih digunakan dalam jadwal akademik!');
        }

        $golongan->delete();

        return redirect()->route('admin.golongan.index')
            ->with('success', 'Golongan berhasil dihapus!');
    }
}
