<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dosen::with('user');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($qry) use ($q) {
                $qry->where('NIP', 'like', '%' . $q . '%')
                    ->orWhere('Nama', 'like', '%' . $q . '%')
                    ->orWhere('Nohp', 'like', '%' . $q . '%');
            });
        }

        $dosen = $query->orderBy('NIP')->paginate(10);

        return view('management.admin.dosen.index', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $linkedUserIds = Dosen::whereNotNull('user_id')->pluck('user_id')->toArray();
        $usersDosen = User::where('role', 'dosen')
            ->orderBy('name')
            ->get();

        return view('management.admin.dosen.create', compact('usersDosen', 'linkedUserIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NIP' => ['required', 'string', 'max:50', 'unique:dosen,NIP'],
            'user_id' => ['nullable', 'exists:users,id'],
            'Nama' => ['required', 'string', 'max:255'],
            'Alamat' => ['required', 'string'],
            'Nohp' => ['required', 'string', 'max:20'],
        ]);

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        $dosen->load('user', 'pengampu.matakuliah');

        return view('management.admin.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        $usersDosen = User::where('role', 'dosen')->orderBy('name')->get();

        return view('management.admin.dosen.edit', compact('dosen', 'usersDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'NIP' => ['required', 'string', 'max:50', Rule::unique('dosen', 'NIP')->ignore($dosen->NIP, 'NIP')],
            'user_id' => ['nullable', 'exists:users,id'],
            'Nama' => ['required', 'string', 'max:255'],
            'Alamat' => ['required', 'string'],
            'Nohp' => ['required', 'string', 'max:20'],
        ]);

        $dosen->update($validated);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->pengampu()->exists()) {
            return redirect()->route('admin.dosen.index')
                ->with('error', 'Dosen tidak dapat dihapus karena masih memiliki data pengampu.');
        }

        $dosen->delete();

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}
