<x-admin-layout>
    <x-slot name="title">Rekap Presensi - Dosen</x-slot>

    <div class="mb-6">
        <a href="{{ route('dosen.presensi.index') }}"
            class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-4">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                    clip-rule="evenodd" />
            </svg>
            Kembali ke Daftar Jadwal
        </a>

        <h2 class="text-2xl font-bold text-gray-900">Rekap Presensi Mahasiswa</h2>
        <p class="mt-1 text-sm text-gray-600">Laporan kehadiran mahasiswa</p>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Jadwal Information -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="p-6 bg-gradient-to-r from-blue-50 to-white border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $jadwal->matakuliah->Nama_mk }}</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ $jadwal->matakuliah->Kode_mk }} • {{ $jadwal->matakuliah->sks }} SKS</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-purple-600 text-white">
                    {{ $jadwal->golongan->nama_Gol }}
                </span>
            </div>
            <div class="mt-4 flex items-center gap-6 text-sm text-gray-600">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $jadwal->hari }}
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $jadwal->ruang->nama_ruang }}
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="text-sm text-blue-600 font-medium mb-1">Total Pertemuan</div>
                    <div class="text-2xl font-bold text-blue-900">{{ $presensiPerTanggal->count() }}</div>
                </div>
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <div class="text-sm text-green-600 font-medium mb-1">Total Mahasiswa</div>
                    <div class="text-2xl font-bold text-green-900">{{ count($statistik) }}</div>
                </div>
                <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                    <div class="text-sm text-purple-600 font-medium mb-1">Rata-rata Kehadiran</div>
                    <div class="text-2xl font-bold text-purple-900">
                        @php
                            $avgKehadiran = count($statistik) > 0 ? collect($statistik)->avg('persentase') : 0;
                        @endphp
                        {{ number_format($avgKehadiran, 1) }}%
                    </div>
                </div>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <a href="{{ route('dosen.presensi.create', $jadwal->id) }}"
                        class="block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                        Input Presensi Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Per Mahasiswa -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center gap-2">
                <div class="h-6 w-1 bg-blue-600 rounded-full"></div>
                <h3 class="text-lg font-bold text-gray-900">Statistik Kehadiran</h3>
            </div>
        </div>

        @if (count($statistik) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hadir
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Izin
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Sakit
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Alpa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Persentase
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($statistik as $index => $stat)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $stat['mahasiswa']->Nama }}</div>
                                    <div class="text-xs text-gray-500">NIM: {{ $stat['mahasiswa']->NIM }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-green-100 text-green-800">
                                        {{ $stat['hadir'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $stat['izin'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-yellow-100 text-yellow-800">
                                        {{ $stat['sakit'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-medium bg-red-100 text-red-800">
                                        {{ $stat['alpa'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center">
                                        <div class="w-full max-w-xs">
                                            <div class="flex items-center">
                                                <div class="flex-1">
                                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                        <div class="h-full rounded-full {{ $stat['persentase'] >= 75 ? 'bg-green-500' : ($stat['persentase'] >= 50 ? 'bg-yellow-500' : 'bg-red-500') }}"
                                                            style="width: {{ $stat['persentase'] }}%"></div>
                                                    </div>
                                                </div>
                                                <span class="ml-2 text-sm font-bold {{ $stat['persentase'] >= 75 ? 'text-green-600' : ($stat['persentase'] >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                                    {{ $stat['persentase'] }}%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada mahasiswa</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada mahasiswa yang terdaftar di kelas ini.</p>
            </div>
        @endif
    </div>

    <!-- Riwayat Presensi Per Tanggal -->
    @if ($presensiPerTanggal->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <div class="h-6 w-1 bg-green-600 rounded-full"></div>
                    <h3 class="text-lg font-bold text-gray-900">Riwayat Presensi</h3>
                </div>
            </div>

            <div class="p-6 space-y-4">
                @foreach ($presensiPerTanggal as $tanggal => $presensiList)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-900">
                                    {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                                </h4>
                                <span class="text-sm text-gray-600">{{ $presensiList->count() }} Mahasiswa</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @php
                                    $hadir = $presensiList->where('status_kehadiran', 'Hadir')->count();
                                    $izin = $presensiList->where('status_kehadiran', 'Izin')->count();
                                    $sakit = $presensiList->where('status_kehadiran', 'Sakit')->count();
                                    $alpa = $presensiList->where('status_kehadiran', 'Alpa')->count();
                                @endphp
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 rounded-lg bg-green-100 flex items-center justify-center">
                                        <span class="text-lg font-bold text-green-600">{{ $hadir }}</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Hadir</div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $hadir }} mhs</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                        <span class="text-lg font-bold text-blue-600">{{ $izin }}</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Izin</div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $izin }} mhs</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                        <span class="text-lg font-bold text-yellow-600">{{ $sakit }}</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Sakit</div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $sakit }} mhs</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center">
                                        <span class="text-lg font-bold text-red-600">{{ $alpa }}</span>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500">Alpa</div>
                                        <div class="text-sm font-semibold text-gray-900">{{ $alpa }} mhs</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-admin-layout>
