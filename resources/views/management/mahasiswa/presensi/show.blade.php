<x-mahasiswa-layout>
    <x-slot name="title">Presensi {{ $matakuliah->Nama_mk }} - Student Portal</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('mahasiswa.presensi.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Presensi Mata Kuliah</h1>
        </div>
        <p class="mt-1 text-sm text-gray-600">{{ $matakuliah->Nama_mk }} ({{ $matakuliah->Kode_mk }})</p>
    </div>

    {{-- Daftar presensi --}}
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Daftar Presensi</h2>
                <p class="text-sm text-gray-600">Riwayat kehadiran {{ $matakuliah->Nama_mk }}</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Hari</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($presensi as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">{{ $item->hari }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status_kehadiran == 'Hadir')
                                    <span class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-medium">Hadir</span>
                                @elseif($item->status_kehadiran == 'Izin')
                                    <span class="inline-flex items-center px-2.5 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-medium">Izin</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-medium">Alpa</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada data presensi untuk mata kuliah ini</p>
                                <p class="text-sm mt-1">Presensi dicatat oleh dosen pengampu setiap pertemuan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Presensi seminggu terakhir (matkul ini) --}}
    @if($presensiSemingguTerakhir->count() > 0)
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Seminggu Terakhir</h2>
                    <p class="text-sm text-gray-600">Presensi 7 hari terakhir untuk {{ $matakuliah->Nama_mk }}</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Hari</th>
                            <th scope="col" class="px-6 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($presensiSemingguTerakhir as $item)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">{{ $item->hari }}</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($item->status_kehadiran == 'Hadir')
                                        <span class="inline-flex items-center px-2.5 py-1 bg-green-100 text-green-800 rounded-lg text-xs font-medium">Hadir</span>
                                    @elseif($item->status_kehadiran == 'Izin')
                                        <span class="inline-flex items-center px-2.5 py-1 bg-yellow-100 text-yellow-800 rounded-lg text-xs font-medium">Izin</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 bg-red-100 text-red-800 rounded-lg text-xs font-medium">Alpa</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</x-mahasiswa-layout>
