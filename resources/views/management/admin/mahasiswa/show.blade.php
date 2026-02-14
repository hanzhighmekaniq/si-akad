<x-admin-layout>
    <x-slot name="title">Detail Mahasiswa {{ $mahasiswa->Nama }} - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Detail Mahasiswa</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Informasi mahasiswa dan KRS</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">NIM</dt>
                    <dd class="mt-1 font-mono font-semibold text-gray-900">{{ $mahasiswa->NIM }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $mahasiswa->Nama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Golongan (Kelas)</dt>
                    <dd class="mt-1">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $mahasiswa->golongan->nama_Gol ?? $mahasiswa->id_Gol }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Semester</dt>
                    <dd class="mt-1 text-gray-900">{{ $mahasiswa->Semester }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Akun User (Login)</dt>
                    <dd class="mt-1">
                        @if($mahasiswa->user)
                            <span class="text-gray-900">{{ $mahasiswa->user->name }}</span>
                            <span class="block text-sm text-gray-500">{{ $mahasiswa->user->email }}</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Belum dihubungkan</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                    <dd class="mt-1 text-gray-900">{{ $mahasiswa->Nohp }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-gray-900">{{ $mahasiswa->Alamat }}</dd>
                </div>
            </dl>
            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->NIM) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Edit Mahasiswa
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <h3 class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200">
            Kartu Rencana Studi - KRS ({{ $mahasiswa->krs->count() }} mata kuliah)
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kode MK</th>
                        <th scope="col" class="px-6 py-3">Nama Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswa->krs as $k)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">{{ $k->matakuliah->Kode_mk ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $k->matakuliah->Nama_mk ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada mata kuliah di KRS</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
