<x-admin-layout>
    <x-slot name="title">Dashboard - SI Akademik</x-slot>

    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
        <p class="mt-1 text-sm text-gray-600">Selamat datang, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Card 1 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100">
                        <svg class="w-6 h-6 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Mahasiswa</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Mahasiswa::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-green-100">
                        <svg class="w-6 h-6 text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Dosen</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Dosen::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-purple-100">
                        <svg class="w-6 h-6 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Mata Kuliah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Matakuliah::count() }}</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-orange-100">
                        <svg class="w-6 h-6 text-orange-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Ruangan</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Ruang::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <!-- Jadwal Hari Ini -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h3>
                <span class="text-sm text-gray-500">{{ now()->format('l, d F Y') }}</span>
            </div>
            <div class="space-y-3">
                @forelse(\App\Models\JadwalAkademik::with(['matakuliah', 'ruang'])->where('hari', now()->locale('id')->dayName)->limit(5)->get() as $jadwal)
                    <div class="flex items-center p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $jadwal->matakuliah->Nama_mk }}</p>
                            <p class="text-xs text-gray-500">{{ $jadwal->ruang->nama_ruang }}</p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded">{{ $jadwal->hari }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Tidak ada jadwal hari ini</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Info -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Cepat</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 rounded-lg bg-blue-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H4Zm0 6h16v6H4v-6Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Golongan Aktif</span>
                    </div>
                    <span class="text-sm font-bold text-blue-600">{{ \App\Models\Golongan::count() }}</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg bg-green-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Total KRS</span>
                    </div>
                    <span class="text-sm font-bold text-green-600">{{ \App\Models\Krs::count() }}</span>
                </div>

                <div class="flex items-center justify-between p-3 rounded-lg bg-purple-50">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-purple-600 mr-3" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11.5c.07 0 .14-.007.207-.021.095.014.193.021.293.021h2a2 2 0 0 0 2-2V7a1 1 0 0 0-1-1h-1a1 1 0 1 0 0 2v11h-2V5a2 2 0 0 0-2-2H5Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Total Jadwal</span>
                    </div>
                    <span class="text-sm font-bold text-purple-600">{{ \App\Models\JadwalAkademik::count() }}</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
