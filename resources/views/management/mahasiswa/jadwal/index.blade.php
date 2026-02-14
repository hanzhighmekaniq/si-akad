<x-mahasiswa-layout>
    <x-slot name="title">Jadwal Kuliah - Student Portal</x-slot>

    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Jadwal Kuliah</h1>
                <p class="text-gray-600 text-sm mt-1">Kelas {{ $mahasiswa->golongan->nama_Gol ?? '-' }} — Semester {{ $mahasiswa->Semester }}</p>
            </div>
            <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>
        </div>
    </div>

    <!-- Penjelasan singkat -->
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-900">
            <strong>Jadwal kuliah</strong> Anda: hari apa kelas dilaksanakan, <strong>mata kuliah</strong> apa, <strong>jam</strong> mulai–selesai, <strong>ruang</strong>, dan <strong>dosen</strong> pengampu. Di bawah ini daftar lengkap per hari dan tabel ringkas.
        </p>
    </div>

    <!-- Info Summary -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-4">
        <!-- Total Jadwal -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Jadwal</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jadwalKuliah->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Hari Kuliah -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Hari Kuliah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jadwalPerHari->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Mata Kuliah -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Mata Kuliah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jadwalKuliah->unique('Kode_mk')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Kelas -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Kelas</p>
                    <p class="text-xl font-bold text-gray-900">{{ $mahasiswa->golongan->nama_Gol ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Ringkas: Semua Jadwal -->
    @if($jadwalKuliah->count() > 0)
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden mb-8">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Daftar Jadwal (Hari, Mata Kuliah, Jam, Ruang, Dosen)</h2>
                <p class="text-sm text-gray-600 mt-0.5">Semua jadwal kuliah kelas Anda dalam satu tabel</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Hari</th>
                            <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                            <th scope="col" class="px-6 py-3">Jam</th>
                            <th scope="col" class="px-6 py-3">Ruang</th>
                            <th scope="col" class="px-6 py-3">Dosen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($jadwalKuliah as $j)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ $j->hari }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ $j->matakuliah->Nama_mk ?? '-' }}</span>
                                    <span class="block text-xs text-gray-500">{{ $j->matakuliah->Kode_mk ?? '' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($j->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H:i') }}</span>
                                    <span class="block text-xs text-gray-500">{{ $j->matakuliah->sks ?? '' }} SKS</span>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ $j->ruang->nama_ruang ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    @if($j->matakuliah && $j->matakuliah->pengampu->isNotEmpty())
                                        {{ $j->matakuliah->pengampu->first()->dosen->Nama ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Jadwal Per Hari (detail per hari) -->
    <h2 class="text-xl font-bold text-gray-900 mb-4">Jadwal per Hari</h2>
    <div class="space-y-6">
        @foreach($daftarHari as $hari)
            @php
                $jadwalHari = $jadwalPerHari->get($hari, collect());
            @endphp
            @if($jadwalHari->count() > 0)
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                    <!-- Header Hari -->
                    <div class="p-4 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Hari {{ $hari }}</h3>
                            <p class="text-sm text-gray-600">{{ $jadwalHari->count() }} mata kuliah</p>
                        </div>
                    </div>

                    <!-- List Jadwal dengan label jelas -->
                    <div class="divide-y divide-gray-200">
                        @foreach($jadwalHari as $jadwal)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Mata Kuliah</p>
                                        <p class="text-lg font-bold text-gray-900 mt-0.5">{{ $jadwal->matakuliah->Nama_mk ?? '-' }}</p>
                                        <p class="text-sm text-gray-500">Kode: {{ $jadwal->matakuliah->Kode_mk ?? '-' }} · {{ $jadwal->matakuliah->sks ?? '-' }} SKS</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jam</p>
                                        <p class="text-lg font-semibold text-gray-900 mt-0.5">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} – {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </p>
                                        <p class="text-sm text-gray-500">Ruang: {{ $jadwal->ruang->nama_ruang ?? '-' }}</p>
                                        <p class="text-sm text-gray-500">Dosen: {{ $jadwal->matakuliah && $jadwal->matakuliah->pengampu->isNotEmpty() ? ($jadwal->matakuliah->pengampu->first()->dosen->Nama ?? '-') : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        @if($jadwalKuliah->count() == 0)
            <div class="bg-white rounded-lg shadow border border-gray-200 p-12 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Jadwal</h3>
                <p class="text-gray-600 text-sm">Jadwal kuliah untuk kelas Anda belum tersedia.</p>
            </div>
        @endif
    </div>

    <!-- Info Footer -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-blue-900 mb-1">Informasi Penting</h4>
                <p class="text-sm text-blue-800">Jadwal kuliah ditampilkan berdasarkan kelas/golongan Anda. Pastikan untuk selalu mengecek jadwal secara berkala untuk menghindari perubahan mendadak.</p>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
