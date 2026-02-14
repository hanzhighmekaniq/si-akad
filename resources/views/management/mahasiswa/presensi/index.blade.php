<x-mahasiswa-layout>
    <x-slot name="title">Presensi Akademik - Student Portal</x-slot>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Presensi Akademik</h1>
                <p class="text-gray-600 text-sm mt-1">{{ $mahasiswa->Nama }} - {{ $mahasiswa->NIM }}</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-5">
        <!-- Total Presensi -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalPresensi }}</p>
                </div>
            </div>
        </div>

        <!-- Hadir -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Hadir</p>
                    <p class="text-2xl font-bold text-green-600">{{ $hadir }}</p>
                </div>
            </div>
        </div>

        <!-- Izin -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Izin</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $izin }}</p>
                </div>
            </div>
        </div>

        <!-- Alpa -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Alpa</p>
                    <p class="text-2xl font-bold text-red-600">{{ $alpa }}</p>
                </div>
            </div>
        </div>

        <!-- Persentase -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow p-5">
            <div class="text-center">
                <p class="text-sm text-white font-medium mb-2">Persentase Kehadiran</p>
                <p class="text-3xl font-bold text-white">{{ $persentaseKehadiran }}%</p>
                <div class="mt-3 bg-white bg-opacity-20 rounded-full h-2">
                    <div class="bg-white rounded-full h-2 transition-all duration-500" style="width: {{ $persentaseKehadiran }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    @if(session('warning'))
        <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-500 rounded-lg shadow-sm p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm font-medium text-yellow-800">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    <!-- Daftar Mata Kuliah -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden mb-8">
        <div class="p-4 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Daftar Mata Kuliah</h2>
                <p class="text-sm text-gray-600">Klik Lihat Presensi untuk melihat riwayat kehadiran per mata kuliah</p>
            </div>
        </div>
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
                <tbody class="divide-y divide-gray-200">
                    @forelse($daftarMatkul as $krs)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">{{ $krs->matakuliah->Kode_mk ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-900">{{ $krs->matakuliah->Nama_mk ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('mahasiswa.presensi.show', $krs->Kode_mk) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Lihat Presensi
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada mata kuliah di KRS</p>
                                <p class="text-sm mt-1">Isi KRS terlebih dahulu dari menu KRS.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Presensi Seminggu Terakhir -->
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Presensi Seminggu Terakhir</h2>
                <p class="text-sm text-gray-600">Riwayat kehadiran 7 hari terakhir</p>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Hari</th>
                        <th scope="col" class="px-6 py-3">Mata Kuliah</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($presensiSemingguTerakhir as $item)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">{{ $item->hari }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-medium text-gray-900">{{ $item->matakuliah->Nama_mk ?? $item->Kode_mk }}</span>
                                <span class="text-gray-500 text-xs block">{{ $item->Kode_mk }}</span>
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
                                <p class="font-medium">Tidak ada presensi dalam 7 hari terakhir</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Info Footer -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-blue-900 mb-1">Informasi Presensi</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• <strong>Hadir:</strong> Anda hadir dan mengikuti perkuliahan dengan baik</li>
                    <li>• <strong>Izin:</strong> Anda tidak hadir dengan alasan yang diizinkan (sakit/keperluan penting)</li>
                    <li>• <strong>Alpa:</strong> Anda tidak hadir tanpa keterangan yang jelas</li>
                    <li>• Presensi dicatat oleh dosen pengampu pada setiap pertemuan</li>
                    <li>• Pastikan persentase kehadiran Anda minimal 75% untuk dapat mengikuti ujian akhir</li>
                </ul>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
