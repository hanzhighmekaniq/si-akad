<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <!-- Student Info Card -->
        <div class="mb-4 p-4 bg-blue-50 rounded-lg border border-blue-100">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-600 truncate">{{ auth()->user()->mahasiswa?->NIM ?? 'Mahasiswa' }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->mahasiswa?->golongan?->nama_Gol ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <ul class="space-y-2 font-medium">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="flex items-center p-3 rounded-lg group {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('mahasiswa.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase">Akademik</p>
            </li>

            <!-- Jadwal Kuliah -->
            <li>
                <a href="{{ route('mahasiswa.jadwal.index') }}"
                    class="flex items-center p-3 rounded-lg group {{ request()->routeIs('mahasiswa.jadwal.index') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('mahasiswa.jadwal.index') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ms-3">Jadwal Kuliah</span>
                </a>
            </li>

            <!-- KRS -->
            <li>
                <a href="{{ route('mahasiswa.krs.index') }}"
                    class="flex items-center p-3 rounded-lg group {{ request()->routeIs('mahasiswa.krs.index') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('mahasiswa.krs.index') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3">KRS Saya</span>
                </a>
            </li>

            <!-- Presensi -->
            <li>
                @php
                    $pendingCount = \App\Http\Controllers\Mahasiswa\PresensiController::getPendingAttendanceCount();
                @endphp
                <a href="{{ route('mahasiswa.presensi.index') }}"
                    class="flex items-center p-3 rounded-lg group {{ request()->routeIs('mahasiswa.presensi.index') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('mahasiswa.presensi.index') ? 'text-white' : 'text-gray-500 group-hover:text-blue-600' }}"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="flex-1 ms-3">Presensi</span>
                    @if($pendingCount > 0)
                        <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full animate-pulse">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>
            </li>

            <!-- Nilai -->
            <li>
                <a href="#"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span class="ms-3">Nilai & Transkrip</span>
                </a>
            </li>

            <!-- Divider -->
            <li class="pt-2 pb-1">
                <p class="px-3 text-xs font-semibold text-gray-400 uppercase">Informasi</p>
            </li>

            <!-- Mata Kuliah -->
            <li>
                <a href="#"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                    </svg>
                    <span class="ms-3">Mata Kuliah</span>
                </a>
            </li>

            <!-- Dosen -->
            <li>
                <a href="#"
                    class="flex items-center p-3 rounded-lg text-gray-700 hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <span class="ms-3">Daftar Dosen</span>
                </a>
            </li>
        </ul>

        <!-- Help Card -->
        <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-gray-900">Butuh Bantuan?</h4>
                    <p class="text-xs text-gray-600 mt-0.5">Hubungi admin untuk informasi lebih lanjut</p>
                    <a href="#" class="inline-block mt-2 text-xs font-semibold text-blue-600 hover:text-blue-800">
                        Kontak Admin →
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
