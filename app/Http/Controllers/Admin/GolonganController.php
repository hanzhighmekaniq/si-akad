<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Golongan::withCount(['mahasiswa', 'jadwalAkademik']);

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
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
     * Tampilkan detail golongan (kelas) dan daftar mahasiswa di dalamnya.
     */
    public function show(Golongan $golongan)
    {
        $golongan->load(['mahasiswa' => fn ($q) => $q->orderBy('NIM')]);
        $golongan->loadCount('jadwalAkademik');

        $mahasiswaLain = Mahasiswa::where('id_Gol', '!=', $golongan->id_Gol)
            ->orderBy('Nama')
            ->get();

        $golonganLain = Golongan::where('id_Gol', '!=', $golongan->id_Gol)->orderBy('nama_Gol')->get();

        return view('management.admin.golongan.show', compact('golongan', 'mahasiswaLain', 'golonganLain'));
    }

    /**
     * Tambah mahasiswa ke golongan ini.
     */
    public function addMahasiswa(Request $request, Golongan $golongan)
    {
        $validated = $request->validate([
            'NIM' => ['required', 'array', 'min:1'],
            'NIM.*' => ['required', 'string', 'exists:mahasiswa,NIM'],
        ], [
            'NIM.required' => 'Pilih minimal satu mahasiswa.',
        ]);

        $count = 0;
        foreach ($validated['NIM'] as $nim) {
            $m = Mahasiswa::find($nim);
            if ($m && $m->id_Gol !== $golongan->id_Gol) {
                $m->update(['id_Gol' => $golongan->id_Gol]);
                $count++;
            }
        }

        $msg = $count > 0
            ? "{$count} mahasiswa berhasil ditambahkan ke golongan {$golongan->nama_Gol}."
            : "Tidak ada mahasiswa baru yang ditambahkan (mungkin sudah ada di golongan ini).";
        return redirect()->route('admin.golongan.show', $golongan->id_Gol)->with('success', $msg);
    }

    /**
     * Pindahkan satu mahasiswa ke golongan lain.
     */
    public function pindahkanMahasiswa(Request $request, Golongan $golongan)
    {
        $validated = $request->validate([
            'NIM' => ['required', 'string', 'exists:mahasiswa,NIM'],
            'id_Gol_tujuan' => ['required', 'string', 'exists:golongan,id_Gol'],
        ]);

        $mhs = Mahasiswa::findOrFail($validated['NIM']);
        if ($mhs->id_Gol !== $golongan->id_Gol) {
            return redirect()->route('admin.golongan.show', $golongan->id_Gol)
                ->with('error', 'Mahasiswa tidak berada di golongan ini.');
        }

        $mhs->update(['id_Gol' => $validated['id_Gol_tujuan']]);
        $tujuan = Golongan::find($validated['id_Gol_tujuan']);

        return redirect()->route('admin.golongan.show', $golongan->id_Gol)
            ->with('success', "{$mhs->Nama} dipindahkan ke {$tujuan->nama_Gol}.");
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
