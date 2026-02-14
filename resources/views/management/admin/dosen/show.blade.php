<x-admin-layout>
    <x-slot name="title">Detail Dosen {{ $dosen->Nama }} - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.dosen.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Detail Dosen</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Informasi dosen dan mata kuliah yang diampu</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">NIP</dt>
                    <dd class="mt-1 font-mono font-semibold text-gray-900">{{ $dosen->NIP }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $dosen->Nama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Akun User (Login)</dt>
                    <dd class="mt-1">
                        @if($dosen->user)
                            <span class="text-gray-900">{{ $dosen->user->name }}</span>
                            <span class="block text-sm text-gray-500">{{ $dosen->user->email }}</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Belum dihubungkan</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                    <dd class="mt-1 text-gray-900">{{ $dosen->Nohp }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-gray-900">{{ $dosen->Alamat }}</dd>
                </div>
            </dl>
            <a href="{{ route('admin.dosen.edit', $dosen->NIP) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Edit Dosen
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <h3 class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200">
            Mata Kuliah yang Diampu ({{ $dosen->pengampu->count() }})
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kode MK</th>
                        <th scope="col" class="px-6 py-3">Nama Mata Kuliah</th>
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
                                <a href="{{ route('admin.pengampu.show', $dosen->NIP) }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat Pengampu</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada mata kuliah yang diampu</p>
                                <p class="text-sm mt-1">Atur dari menu Pengampu (Dosen – Mata Kuliah)</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
