<x-mahasiswa-layout>
    <x-slot name="title">Check In Presensi - Student Portal</x-slot>

    <!-- Page Header -->
    <div class="mb-8">
        <a href="{{ route('mahasiswa.presensi.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
            </svg>
            Kembali ke Daftar Presensi
        </a>

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Check In Presensi</h1>
                <p class="text-gray-600 text-sm mt-1">Konfirmasi kehadiran Anda untuk perkuliahan hari ini</p>
            </div>
        </div>
    </div>

    <!-- Current Time Info -->
    <div class="mb-6 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-blue-100">Waktu Sekarang</p>
                    <p class="text-2xl font-bold">{{ $now->format('H:i') }}</p>
                    <p class="text-sm text-blue-100">{{ $today->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm font-medium text-blue-100">Mahasiswa</p>
                <p class="text-lg font-bold">{{ $mahasiswa->Nama }}</p>
                <p class="text-sm text-blue-100">{{ $mahasiswa->NIM }}</p>
            </div>
        </div>
    </div>

    <!-- Course Information -->
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden mb-6">
        <div class="bg-gradient-to-r from-indigo-50 to-blue-50 border-b border-gray-200 p-6">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-indigo-600 text-white shadow-sm">
                            {{ $jadwal->matakuliah->Kode_mk }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-purple-600 text-white shadow-sm">
                            {{ $jadwal->golongan->nama_Gol }}
                        </span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $jadwal->matakuliah->Nama_mk }}</h2>
                    <p class="text-sm text-gray-600">{{ $jadwal->matakuliah->sks }} SKS</p>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Day -->
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Hari</p>
                        <p class="text-lg font-bold text-gray-900">{{ $jadwal->hari }}</p>
                    </div>
                </div>

                <!-- Time -->
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Waktu Perkuliahan</p>
                        <p class="text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                    </div>
                </div>

                <!-- Room -->
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ruangan</p>
                        <p class="text-lg font-bold text-gray-900">{{ $jadwal->ruang->nama_ruang }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Check In Status -->
    @if($canCheckIn)
        <!-- Can Check In - Show Form -->
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-bold text-green-900 mb-1">Waktu Check In Tersedia</h3>
                    <p class="text-sm text-green-800">Anda dapat melakukan check-in presensi untuk mata kuliah ini sekarang.</p>
                    <p class="text-xs text-green-700 mt-2">Waktu check-in: {{ $allowCheckInFrom->format('H:i') }} - {{ $allowCheckInUntil->format('H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Check In Form -->
        <form action="{{ route('mahasiswa.presensi.store') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin melakukan check-in untuk mata kuliah ini?');">
            @csrf
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

            <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-8 text-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Kehadiran</h3>
                    <p class="text-gray-600 mb-8">Klik tombol di bawah untuk melakukan check-in dan mencatat kehadiran Anda</p>

                    <div class="flex justify-center gap-4">
                        <a href="{{ route('mahasiswa.presensi.index') }}" 
                           class="px-8 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold rounded-lg transition-colors">
                            Batal
                        </a>
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Konfirmasi Check In
                        </button>
                    </div>
                </div>
            </div>
        </form>

    @else
        <!-- Cannot Check In Yet -->
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4 flex-1">
                    <h3 class="text-lg font-bold text-amber-900 mb-1">Waktu Check In Belum Tersedia</h3>
                    @if($now->lt($allowCheckInFrom))
                        <p class="text-sm text-amber-800">Check-in akan tersedia mulai <strong>{{ $allowCheckInFrom->format('H:i') }}</strong> (30 menit sebelum perkuliahan dimulai).</p>
                        <p class="text-xs text-amber-700 mt-2">Silakan kembali lagi pada waktu yang ditentukan.</p>
                    @else
                        <p class="text-sm text-amber-800">Waktu check-in telah berakhir. Check-in hanya dapat dilakukan hingga <strong>{{ $allowCheckInUntil->format('H:i') }}</strong> (akhir waktu perkuliahan).</p>
                        <p class="text-xs text-amber-700 mt-2">Jika Anda hadir, silakan hubungi dosen pengampu untuk mencatat kehadiran Anda.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-8 text-center">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Check In Tidak Tersedia</h3>
                <p class="text-gray-600 mb-8">
                    Waktu check-in: <strong>{{ $allowCheckInFrom->format('H:i') }} - {{ $allowCheckInUntil->format('H:i') }}</strong>
                </p>

                <a href="{{ route('mahasiswa.presensi.index') }}" 
                   class="inline-flex items-center px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    Kembali ke Daftar Presensi
                </a>
            </div>
        </div>
    @endif

    <!-- Information Box -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-bold text-blue-900 mb-2">Informasi Penting</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• Check-in dapat dilakukan mulai <strong>30 menit sebelum</strong> perkuliahan dimulai</li>
                    <li>• Check-in hanya tersedia hingga <strong>akhir waktu</strong> perkuliahan</li>
                    <li>• Pastikan Anda berada di lokasi perkuliahan saat melakukan check-in</li>
                    <li>• Satu kali check-in per mata kuliah per hari</li>
                    <li>• Presensi yang tercatat tidak dapat diubah atau dibatalkan</li>
                </ul>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
