<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ruang::query();

        // Search by id_ruang or nama_ruang
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('id_ruang', 'like', '%' . $request->search . '%')
                  ->orWhere('nama_ruang', 'like', '%' . $request->search . '%');
            });
        }

        $ruang = $query->orderBy('nama_ruang')->paginate(10);

        return view('management.admin.ruang.index', compact('ruang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.admin.ruang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ruang' => ['required', 'string', 'max:255', 'unique:ruang,id_ruang'],
            'nama_ruang' => ['required', 'string', 'max:255'],
        ], [
            'id_ruang.required' => 'ID ruangan wajib diisi',
            'id_ruang.unique' => 'ID ruangan sudah digunakan',
            'nama_ruang.required' => 'Nama ruangan wajib diisi',
        ]);

        Ruang::create($validated);

        return redirect()->route('admin.ruang.index')
            ->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_ruang)
    {
        $ruang = Ruang::findOrFail($id_ruang);
        return view('management.admin.ruang.show', compact('ruang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_ruang)
    {
        $ruang = Ruang::findOrFail($id_ruang);
        return view('management.admin.ruang.edit', compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_ruang)
    {
        $ruang = Ruang::findOrFail($id_ruang);

        $validated = $request->validate([
            'id_ruang' => ['required', 'string', 'max:255', 'unique:ruang,id_ruang,' . $id_ruang . ',id_ruang'],
            'nama_ruang' => ['required', 'string', 'max:255'],
        ], [
            'id_ruang.required' => 'ID ruangan wajib diisi',
            'id_ruang.unique' => 'ID ruangan sudah digunakan',
            'nama_ruang.required' => 'Nama ruangan wajib diisi',
        ]);

        $ruang->update($validated);

        return redirect()->route('admin.ruang.index')
            ->with('success', 'Ruangan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ruang)
    {
        $ruang = Ruang::findOrFail($id_ruang);

        // Check if ruang is being used in jadwal
        if ($ruang->jadwalAkademik()->count() > 0) {
            return redirect()->route('admin.ruang.index')
                ->with('error', 'Ruangan tidak dapat dihapus karena masih digunakan dalam jadwal akademik!');
        }

        $ruang->delete();

        return redirect()->route('admin.ruang.index')
            ->with('success', 'Ruangan berhasil dihapus!');
    }
}
