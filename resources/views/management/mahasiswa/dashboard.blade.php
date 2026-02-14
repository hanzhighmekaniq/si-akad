<x-mahasiswa-layout>
    <x-slot name="title">Dashboard - Student Portal</x-slot>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-800">{{ session('error') }}</div>
    @endif
    @if(!$mahasiswa)
        <div class="mb-8 p-6 bg-white rounded-lg shadow border border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Halo, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-gray-600 text-sm mb-3">Selamat datang di Student Portal</p>
            <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                <strong>Data profil mahasiswa belum diisi.</strong> Akun Anda (role mahasiswa) belum terhubung ke data mahasiswa (NIM, nama, golongan, dll.). Silakan hubungi administrator agar data Anda diisi, lalu fitur KRS, jadwal, dan presensi dapat digunakan.
            </div>
        </div>
    @else
    <!-- Welcome Header -->
    <div class="mb-8 p-6 bg-white rounded-lg shadow border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Halo, {{ $mahasiswa->Nama }}! 👋</h2>
                <p class="text-gray-600 text-sm mb-3">Selamat datang kembali di Student Portal</p>
                <div class="flex items-center gap-3 mt-3">
                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-lg text-xs font-semibold text-gray-700">
                        <svg class="w-3 h-3 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        {{ $mahasiswa->NIM }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-lg text-xs font-semibold text-gray-700">
                        <svg class="w-3 h-3 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                        Semester {{ $mahasiswa->Semester }}
                    </span>
                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-lg text-xs font-semibold text-gray-700">
                        <svg class="w-3 h-3 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $mahasiswa->golongan->nama_Gol }}
                    </span>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="w-20 h-20 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-3">
        <!-- Total KRS -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Mata Kuliah Diambil</p>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $krs->count() }}</p>
            <p class="text-gray-500 text-xs">Mata kuliah semester ini</p>
        </div>

        <!-- Total SKS -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Total SKS</p>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $krs->sum(function($k) { return $k->matakuliah->sks; }) }}</p>
            <p class="text-gray-500 text-xs">Satuan Kredit Semester</p>
        </div>

        <!-- Jadwal Kuliah -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <p class="text-gray-600 text-sm font-medium mb-1">Jadwal Kuliah</p>
            <p class="text-3xl font-bold text-gray-900 mb-1">{{ $jadwalKuliah->count() }}</p>
            <p class="text-gray-500 text-xs">Pertemuan minggu ini</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- KRS -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Kartu Rencana Studi</h3>
                        <p class="text-xs text-gray-500">Semester {{ $mahasiswa->Semester }}</p>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                @forelse($krs as $item)
                    <div class="flex items-center p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-bold text-gray-900">{{ $item->matakuliah->Nama_mk }}</p>
                            <p class="text-xs text-gray-600 mt-1">
                                <span class="font-mono font-semibold text-blue-600">{{ $item->matakuliah->Kode_mk }}</span>
                                <span class="mx-2">•</span>
                                <span class="font-semibold">{{ $item->matakuliah->sks }} SKS</span>
                            </p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg bg-green-100 text-green-700">
                            ✓ Aktif
                        </span>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600">Belum ada KRS</p>
                        <p class="text-xs text-gray-500 mt-1">Silakan hubungi admin untuk mengisi KRS</p>
                    </div>
                @endforelse

                @if($krs->count() > 0)
                    <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-semibold text-gray-700">Total SKS Semester Ini</span>
                            <span class="text-2xl font-bold text-blue-600">{{ $krs->sum(function($k) { return $k->matakuliah->sks; }) }} SKS</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Jadwal Kuliah -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Jadwal Kuliah</h3>
                        <p class="text-xs text-gray-500">Minggu ini</p>
                    </div>
                </div>
            </div>
            <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                @forelse($jadwalKuliah->groupBy('hari') as $hari => $jadwals)
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="h-8 w-1 bg-blue-600 rounded-full"></div>
                            <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide">{{ $hari }}</h4>
                        </div>
                        @foreach($jadwals as $jadwal)
                            <div class="ml-4 mb-3 p-4 rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-900 mb-2">{{ $jadwal->matakuliah->Nama_mk }}</p>
                                        <div class="flex flex-wrap items-center gap-3 text-xs">
                                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg font-semibold">
                                                <svg class="w-3 h-3 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $jadwal->ruang->nama_ruang }}
                                            </span>
                                            <span class="inline-flex items-center px-2.5 py-1 bg-gray-100 text-gray-700 rounded-lg font-semibold">
                                                <svg class="w-3 h-3 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                                {{ $jadwal->matakuliah->sks }} SKS
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-600">Belum ada jadwal kuliah</p>
                        <p class="text-xs text-gray-500 mt-1">Jadwal akan ditampilkan setelah KRS disetujui</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Presensi Terbaru -->
    <div class="mt-8 bg-white rounded-lg shadow border border-gray-200 p-6 hover:shadow-lg transition-shadow">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Presensi Terbaru</h3>
                    <p class="text-xs text-gray-500">Riwayat kehadiran</p>
                </div>
            </div>
            <a href="#" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-semibold transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Hari
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Mata Kuliah
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($presensi as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                {{ $item->tanggal->format('d M Y') }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $item->hari }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->matakuliah->Nama_mk }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if($item->status_kehadiran == 'Hadir')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-green-100 text-green-700">
                                        ✓ Hadir
                                    </span>
                                @elseif($item->status_kehadiran == 'Izin')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-blue-100 text-blue-700">
                                        ⓘ Izin
                                    </span>
                                @elseif($item->status_kehadiran == 'Sakit')
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-yellow-100 text-yellow-700">
                                        + Sakit
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-bold bg-red-100 text-red-700">
                                        ✕ Alpa
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-600">Belum ada data presensi</p>
                                    <p class="text-xs text-gray-500 mt-1">Presensi akan muncul setelah mengikuti perkuliahan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 bg-white rounded-lg shadow border border-gray-200 p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <a href="#" class="flex flex-col items-center text-center p-5 bg-gray-50 rounded-lg hover:bg-blue-50 hover:shadow-md transition-all">
                <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-900">Lihat KRS</span>
            </a>

            <a href="#" class="flex flex-col items-center text-center p-5 bg-gray-50 rounded-lg hover:bg-blue-50 hover:shadow-md transition-all">
                <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-900">Riwayat Presensi</span>
            </a>

            <a href="#" class="flex flex-col items-center text-center p-5 bg-gray-50 rounded-lg hover:bg-blue-50 hover:shadow-md transition-all">
                <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-900">Lihat Nilai</span>
            </a>

            <a href="#" class="flex flex-col items-center text-center p-5 bg-gray-50 rounded-lg hover:bg-blue-50 hover:shadow-md transition-all">
                <div class="w-14 h-14 bg-blue-600 rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="text-sm font-bold text-gray-900">Jadwal Kuliah</span>
            </a>
        </div>
    </div>
    @endif
</x-mahasiswa-layout>
