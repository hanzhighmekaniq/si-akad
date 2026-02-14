<x-admin-layout>
    <x-slot name="title">Detail Pengampu - {{ $dosen->Nama }}</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.pengampu.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Detail Pengampu</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Mata kuliah yang diampu oleh dosen</p>
    </div>

    {{-- Info Dosen --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Data Dosen</h3>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                <dd class="mt-1 text-gray-900">{{ $dosen->Nama }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">NIP</dt>
                <dd class="mt-1 font-mono text-gray-900">{{ $dosen->NIP }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                <dd class="mt-1 text-gray-900">{{ $dosen->Nohp ?? '—' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="mt-1 text-gray-900">{{ $dosen->Alamat ?? '—' }}</dd>
            </div>
        </dl>
        <div class="mt-4 pt-4 border-t border-gray-200 flex gap-2">
            <a href="{{ route('admin.pengampu.edit', $dosen->NIP) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Edit Mata Kuliah
            </a>
            <a href="{{ route('admin.pengampu.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                Kembali ke Daftar
            </a>
        </div>
    </div>

    {{-- Daftar Mata Kuliah --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <h3 class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200">
            Mata Kuliah yang Diampu ({{ $dosen->pengampu->count() }})
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kode</th>
                        <th scope="col" class="px-6 py-3">Nama Mata Kuliah</th>
                        <th scope="col" class="px-6 py-3 text-center">SKS</th>
                        <th scope="col" class="px-6 py-3 text-center">Semester</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dosen->pengampu as $p)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">{{ $p->matakuliah->Kode_mk ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $p->matakuliah->Nama_mk ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $p->matakuliah->sks ?? '-' }} SKS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">Semester {{ $p->matakuliah->semester ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.pengampu.destroy') }}" method="POST" class="inline"
                                    onsubmit="return confirm('Lepas mata kuliah {{ $p->matakuliah->Nama_mk ?? $p->Kode_mk }} dari dosen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="NIP" value="{{ $dosen->NIP }}">
                                    <input type="hidden" name="Kode_mk" value="{{ $p->Kode_mk }}">
                                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700" title="Lepas pengampu">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Dosen ini belum mengampu mata kuliah</p>
                                <p class="text-sm mt-1">
                                    <a href="{{ route('admin.pengampu.edit', $dosen->NIP) }}" class="text-blue-600 hover:underline">Edit pengampu</a> untuk menambahkan mata kuliah.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
