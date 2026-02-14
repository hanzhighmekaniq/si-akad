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

    <!-- Belum Absen Alert -->
    @if($belumAbsen->count() > 0)
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-lg shadow-sm p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-lg font-bold text-blue-900">Kelas Hari Ini ({{ $hariIni }})</h3>
                    <p class="text-sm text-blue-800 mt-1 mb-4">Anda memiliki {{ $belumAbsen->count() }} kelas yang belum tercatat presensinya. Lakukan check-in pada waktu perkuliahan:</p>
                    <div class="space-y-3">
                        @foreach($belumAbsen as $jadwal)
                            @php
                                $jamMulai = \Carbon\Carbon::parse($jadwal->jam_mulai);
                                $jamSelesai = \Carbon\Carbon::parse($jadwal->jam_selesai);
                                $allowCheckInFrom = $jamMulai->copy()->subMinutes(30);
                                $allowCheckInUntil = $jamSelesai->copy();
                                $now = \Carbon\Carbon::now();
                                $canCheckIn = $now->between($allowCheckInFrom, $allowCheckInUntil);
                            @endphp
                            <div class="flex items-center gap-3 bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition-shadow">
                                <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex flex-col items-center justify-center text-white shadow-md">
                                    <span class="text-xs font-medium">Mulai</span>
                                    <span class="text-lg font-bold">{{ $jamMulai->format('H:i') }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $jadwal->matakuliah->Nama_mk }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-sm text-gray-600">{{ $jadwal->ruang->nama_ruang }}</p>
                                        <span class="text-gray-400">•</span>
                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-sm text-gray-600">{{ $jamMulai->format('H:i') }} - {{ $jamSelesai->format('H:i') }}</p>
                                    </div>
                                    @if($canCheckIn)
                                        <p class="text-xs text-green-600 font-medium mt-2">✓ Waktu check-in tersedia sekarang</p>
                                    @else
                                        <p class="text-xs text-gray-500 mt-2">Check-in tersedia {{ $allowCheckInFrom->format('H:i') }} - {{ $allowCheckInUntil->format('H:i') }}</p>
                                    @endif
                                </div>
                                <div class="flex-shrink-0">
                                    @if($canCheckIn)
                                        <a href="{{ route('mahasiswa.presensi.create', $jadwal->id) }}" 
                                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Check In
                                        </a>
                                    @else
                                        <button disabled 
                                                class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-500 font-bold rounded-lg cursor-not-allowed opacity-60">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Belum Waktunya
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 p-3 bg-blue-100 bg-opacity-50 rounded-lg">
                        <p class="text-xs text-blue-800 flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <span><strong>Info:</strong> Anda dapat melakukan check-in mulai 30 menit sebelum perkuliahan hingga akhir waktu kuliah.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Presensi History -->
    @if($presensi->count() > 0)
        <div class="space-y-6">
            @foreach($presensiByMonth as $month => $items)
                <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                    <!-- Month Header -->
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <h2 class="text-xl font-bold text-white">{{ \Carbon\Carbon::parse($month . '-01')->isoFormat('MMMM YYYY') }}</h2>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-lg text-sm font-semibold text-white">
                                {{ $items->count() }} Pertemuan
                            </span>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-gray-50 text-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold">Tanggal</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Hari</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Mata Kuliah</th>
                                    <th scope="col" class="px-6 py-4 font-bold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($items as $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg font-medium text-xs">
                                                {{ $item->hari }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="font-semibold text-gray-900">{{ $item->matakuliah->Nama_mk }}</div>
                                                <div class="text-xs text-gray-500">{{ $item->matakuliah->Kode_mk }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($item->status_kehadiran == 'Hadir')
                                                <span class="inline-flex items-center px-3 py-1.5 bg-green-100 text-green-800 rounded-lg font-bold text-sm">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Hadir
                                                </span>
                                            @elseif($item->status_kehadiran == 'Izin')
                                                <span class="inline-flex items-center px-3 py-1.5 bg-yellow-100 text-yellow-800 rounded-lg font-bold text-sm">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Izin
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-800 rounded-lg font-bold text-sm">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Alpa
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-12 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Riwayat Presensi</h3>
            <p class="text-gray-600 text-sm">Riwayat presensi Anda akan muncul di sini setelah dosen melakukan pencatatan kehadiran.</p>
        </div>
    @endif

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
