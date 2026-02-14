<x-admin-layout>
    <x-slot name="title">Ruangan {{ $ruang->nama_ruang }} - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.ruang.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Detail Ruangan</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Informasi ruangan dan jadwal yang menggunakan ruangan ini</p>
    </div>

    {{-- Info Ruangan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID Ruangan</dt>
                    <dd class="mt-1 font-mono font-semibold text-gray-900">{{ $ruang->id_ruang }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama Ruangan</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $ruang->nama_ruang }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jumlah Jadwal</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $ruang->jadwalAkademik->count() }} jadwal</dd>
                </div>
            </dl>
            <a href="{{ route('admin.ruang.edit', $ruang->id_ruang) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Edit Ruangan
            </a>
        </div>
    </div>

    {{-- Daftar Jadwal yang menggunakan ruangan ini (relasi: golongan + matakuliah) --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <h3 class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200">
            Jadwal di Ruangan Ini ({{ $ruang->jadwalAkademik->count() }})
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Hari</th>
                        <th scope="col" class="px-6 py-3">Jam</th>
                        <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                        <th scope="col" class="px-6 py-3">Golongan (Kelas)</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ruang->jadwalAkademik as $j)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">{{ $j->hari }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono text-gray-700">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono font-semibold text-gray-900">{{ $j->matakuliah->Kode_mk ?? '-' }}</span>
                                <span class="block text-gray-600">{{ $j->matakuliah->Nama_mk ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $j->golongan->nama_Gol ?? $j->id_Gol }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.jadwal.edit', $j->id) }}"
                                    class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                    Edit Jadwal
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada jadwal yang menggunakan ruangan ini</p>
                                <p class="text-sm mt-1">Jadwal dapat ditambahkan dari menu Jadwal Akademik.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
