<x-admin-layout>
    <x-slot name="title">Dosen Dashboard - SI Akademik</x-slot>

    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Dashboard Dosen</h2>
        @if($dosen)
            <p class="mt-1 text-sm text-gray-600">Selamat datang, {{ $dosen->Nama }}!</p>
            <p class="text-xs text-gray-500">NIP: {{ $dosen->NIP }}</p>
        @else
            <p class="mt-1 text-sm text-amber-700">Selamat datang, {{ auth()->user()->name }}!</p>
            <div class="mt-2 p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                <strong>Data profil dosen belum diisi.</strong> Akun Anda (role dosen) belum terhubung ke data dosen. Silakan hubungi administrator untuk mengisi data dosen (NIP, nama, dll.) agar fitur jadwal dan presensi dapat digunakan.
            </div>
        @endif
    </div>

    @if($dosen)
    <!-- Jadwal Hari Ini & Besok -->
    <div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-2">
        <!-- Jadwal Hari Ini -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 {{ $jadwalHariIni->count() > 0 ? 'bg-blue-50 border-b border-blue-100' : 'bg-gray-50 border-b border-gray-200' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ $jadwalHariIni->count() > 0 ? 'bg-blue-100' : 'bg-gray-200' }}">
                            <svg class="w-5 h-5 {{ $jadwalHariIni->count() > 0 ? 'text-blue-600' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Jadwal Hari Ini</h3>
                            <p class="text-sm text-gray-600">{{ $hariIni }}, {{ $today->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold {{ $jadwalHariIni->count() > 0 ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                        {{ $jadwalHariIni->count() }} jadwal
                    </span>
                </div>
            </div>
            <div class="p-4 max-h-64 overflow-y-auto">
                @if($jadwalHariIni->count() > 0)
                    <ul class="space-y-3">
                        @foreach($jadwalHariIni as $j)
                            <li class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $j->matakuliah->Nama_mk }}</p>
                                    <p class="text-xs text-gray-500">{{ $j->jam_mulai }}–{{ $j->jam_selesai }} · {{ $j->ruang->nama_ruang }} · {{ $j->golongan->nama_Gol }}</p>
                                </div>
                                <a href="{{ route('dosen.presensi.create', $j->id) }}" class="ml-2 flex-shrink-0 inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded-lg bg-green-600 text-white hover:bg-green-700">Presensi</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('dosen.jadwal.index') }}?hari={{ urlencode($hariIni) }}" class="mt-3 block text-center text-sm font-medium text-blue-600 hover:text-blue-800">Lihat semua jadwal →</a>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal mengajar hari ini</p>
                        <p class="text-xs text-gray-500">Nikmati hari bebas mengajar atau cek jadwal besok di samping.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Jadwal Besok -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 {{ $jadwalBesok->count() > 0 ? 'bg-emerald-50 border-b border-emerald-100' : 'bg-gray-50 border-b border-gray-200' }}">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ $jadwalBesok->count() > 0 ? 'bg-emerald-100' : 'bg-gray-200' }}">
                            <svg class="w-5 h-5 {{ $jadwalBesok->count() > 0 ? 'text-emerald-600' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Jadwal Besok</h3>
                            <p class="text-sm text-gray-600">{{ $besok }}, {{ $today->copy()->addDay()->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-sm font-semibold {{ $jadwalBesok->count() > 0 ? 'bg-emerald-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                        {{ $jadwalBesok->count() }} jadwal
                    </span>
                </div>
            </div>
            <div class="p-4 max-h-64 overflow-y-auto">
                @if($jadwalBesok->count() > 0)
                    <ul class="space-y-3">
                        @foreach($jadwalBesok as $j)
                            <li class="flex items-center justify-between p-3 rounded-lg border border-gray-200 hover:bg-gray-50">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $j->matakuliah->Nama_mk }}</p>
                                    <p class="text-xs text-gray-500">{{ $j->jam_mulai }}–{{ $j->jam_selesai }} · {{ $j->ruang->nama_ruang }} · {{ $j->golongan->nama_Gol }}</p>
                                </div>
                                <a href="{{ route('dosen.jadwal.show', $j->id) }}" class="ml-2 flex-shrink-0 inline-flex items-center px-2.5 py-1.5 text-xs font-medium rounded-lg bg-gray-200 text-gray-800 hover:bg-gray-300">Detail</a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('dosen.jadwal.index') }}?hari={{ urlencode($besok) }}" class="mt-3 block text-center text-sm font-medium text-emerald-600 hover:text-emerald-800">Lihat jadwal besok →</a>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal besok</p>
                        <p class="text-xs text-gray-500">Lihat jadwal minggu ini di bawah untuk rencana ke depan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-3">
        <!-- Total Mata Kuliah -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Mata Kuliah Diampu</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $matakuliah->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Jadwal Mengajar -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Jadwal Mengajar</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jadwalMengajar->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Kelas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $jadwalMengajar->count() > 0 ? $jadwalMengajar->unique('id_Gol')->count() : 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Mata Kuliah yang Diampu -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Mata Kuliah yang Diampu</h3>
            </div>
            <div class="space-y-3">
                @forelse($matakuliah as $mk)
                    <div class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                        <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-semibold text-gray-900">{{ $mk->matakuliah->Nama_mk }}</p>
                            <p class="text-xs text-gray-500">{{ $mk->matakuliah->Kode_mk }} • {{ $mk->matakuliah->sks }}
                                SKS • Semester {{ $mk->matakuliah->semester }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada mata kuliah yang diampu</p>
                @endforelse
            </div>
        </div>

        <!-- Jadwal Mengajar (semua / filter per hari) -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                <h3 class="text-lg font-semibold text-gray-900">Jadwal Mengajar</h3>
                @if($dosen && $jadwalMingguIni->count() > 0)
                    <div class="flex flex-wrap gap-1">
                        @foreach($jadwalMingguIni->keys() as $hari)
                            <a href="{{ route('dosen.jadwal.index') }}?hari={{ urlencode($hari) }}"
                                class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-lg {{ $hari === $hariIni ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                {{ $hari }}
                                <span class="ml-1 opacity-80">({{ $jadwalMingguIni[$hari]->count() }})</span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse($jadwalMengajar as $jadwal)
                    <div class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-900">{{ $jadwal->matakuliah->Nama_mk }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        {{ $jadwal->hari }}
                                    </span>
                                </p>
                                <p class="text-xs text-gray-500">
                                    <span class="inline-flex items-center mr-3">
                                        <svg class="w-3 h-3 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $jadwal->ruang->nama_ruang }}
                                    </span>
                                    <span class="inline-flex items-center">
                                        <svg class="w-3 h-3 mr-1" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M4 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H4Zm0 6h16v6H4v-6Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $jadwal->golongan->nama_Gol }}
                                    </span>
                                </p>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada jadwal mengajar</p>
                @endforelse
            </div>
            @if($dosen && $jadwalMengajar->count() > 0)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="{{ route('dosen.jadwal.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">Lihat semua jadwal & presensi →</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
            <a href="{{ $dosen ? route('dosen.presensi.index') : '#' }}"
                class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition group {{ !$dosen ? 'opacity-60 pointer-events-none' : '' }}">
                <div
                    class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                    <svg class="w-5 h-5 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900">Presensi</span>
            </a>

            <a href="{{ $dosen ? route('dosen.jadwal.index') : '#' }}"
                class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition group {{ !$dosen ? 'opacity-60 pointer-events-none' : '' }}">
                <div
                    class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition">
                    <svg class="w-5 h-5 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Zm7 4a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h.5a1 1 0 1 1 0 2H13a1 1 0 0 1-1-1Zm-6 4a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H7a1 1 0 0 1-1-1ZM7 6a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7Zm1 3V8h1v1H8Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900">Jadwal Mengajar</span>
            </a>

            <a href="#"
                class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition group">
                <div
                    class="flex-shrink-0 w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition">
                    <svg class="w-5 h-5 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z" />
                        <path fill-rule="evenodd"
                            d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.772.223l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z" />
                    </svg>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900">Input Nilai</span>
            </a>

            <a href="#"
                class="flex items-center p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition group">
                <div
                    class="flex-shrink-0 w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition">
                    <svg class="w-5 h-5 text-orange-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <span class="ml-3 text-sm font-medium text-gray-900">Laporan</span>
            </a>
        </div>
    </div>
</x-admin-layout>
