<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Models\Golongan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mahasiswa::with('user', 'golongan');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('NIM', 'like', '%' . $q . '%')
                    ->orWhere('Nama', 'like', '%' . $q . '%')
                    ->orWhere('Nohp', 'like', '%' . $q . '%');
            });
        }

        if ($request->filled('golongan')) {
            $query->where('id_Gol', $request->golongan);
        }

        $mahasiswa = $query->orderBy('NIM')->paginate(10);
        $golongan = Golongan::orderBy('id_Gol')->get();

        return view('management.admin.mahasiswa.index', compact('mahasiswa', 'golongan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $linkedUserIds = Mahasiswa::whereNotNull('user_id')->pluck('user_id')->toArray();
        $usersMahasiswa = User::where('role', 'mahasiswa')->orderBy('name')->get();
        $golongan = Golongan::orderBy('id_Gol')->get();

        return view('management.admin.mahasiswa.create', compact('usersMahasiswa', 'linkedUserIds', 'golongan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIM' => ['required', 'string', 'max:50', 'unique:mahasiswa,NIM'],
            'user_id' => ['nullable', 'exists:users,id'],
            'Nama' => ['required', 'string', 'max:255'],
            'Alamat' => ['required', 'string'],
            'Nohp' => ['required', 'string', 'max:20'],
            'Semester' => ['required', 'integer', 'min:1', 'max:14'],
            'id_Gol' => ['required', 'exists:golongan,id_Gol'],
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('user', 'golongan', 'krs.matakuliah');

        return view('management.admin.mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $usersMahasiswa = User::where('role', 'mahasiswa')->orderBy('name')->get();
        $golongan = Golongan::orderBy('id_Gol')->get();

        return view('management.admin.mahasiswa.edit', compact('mahasiswa', 'usersMahasiswa', 'golongan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'NIM' => ['required', 'string', 'max:50', Rule::unique('mahasiswa', 'NIM')->ignore($mahasiswa->NIM, 'NIM')],
            'user_id' => ['nullable', 'exists:users,id'],
            'Nama' => ['required', 'string', 'max:255'],
            'Alamat' => ['required', 'string'],
            'Nohp' => ['required', 'string', 'max:20'],
            'Semester' => ['required', 'integer', 'min:1', 'max:14'],
            'id_Gol' => ['required', 'exists:golongan,id_Gol'],
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->krs()->exists() || $mahasiswa->presensi()->exists()) {
            return redirect()->route('admin.mahasiswa.index')
                ->with('error', 'Mahasiswa tidak dapat dihapus karena masih memiliki data KRS atau presensi.');
        }

        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
