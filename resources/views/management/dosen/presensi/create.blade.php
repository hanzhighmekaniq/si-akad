<x-admin-layout>
    <x-slot name="title">Input Presensi - Dosen</x-slot>

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

        <h2 class="text-2xl font-bold text-gray-900">Input Presensi Mahasiswa</h2>
        <p class="mt-1 text-sm text-gray-600">Catat kehadiran mahasiswa pada perkuliahan</p>
    </div>

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
    </div>

    @if (count($existingPresensi) > 0)
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">Presensi untuk tanggal ini sudah ada. Simpan ulang akan menimpa data sebelumnya.</span>
            </div>
        </div>
    @endif

    <!-- Presensi Form -->
    <form action="{{ route('dosen.presensi.store', $jadwal->id) }}" method="POST" id="presensiForm">
        @csrf
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-4">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="h-6 w-1 bg-blue-600 rounded-full"></div>
                        <h3 class="text-lg font-bold text-gray-900">Daftar Mahasiswa</h3>
                    </div>
                    <div class="flex items-center gap-3">
                        <label for="tanggal" class="text-sm font-medium text-gray-700">Tanggal:</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ $today }}" required
                            class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            @if ($mahasiswaList->count() > 0)
                <div class="p-4">
                    <!-- Quick Actions -->
                    <div class="mb-4 p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-gray-700">Tandai Semua:</span>
                            <div class="flex gap-2">
                                <button type="button" onclick="setAllStatus('Hadir')"
                                    class="px-3 py-1 bg-green-100 hover:bg-green-200 text-green-800 text-xs font-medium rounded-lg transition">
                                    Hadir
                                </button>
                                <button type="button" onclick="setAllStatus('Izin')"
                                    class="px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-medium rounded-lg transition">
                                    Izin
                                </button>
                                <button type="button" onclick="setAllStatus('Sakit')"
                                    class="px-3 py-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 text-xs font-medium rounded-lg transition">
                                    Sakit
                                </button>
                                <button type="button" onclick="setAllStatus('Alpa')"
                                    class="px-3 py-1 bg-red-100 hover:bg-red-200 text-red-800 text-xs font-medium rounded-lg transition">
                                    Alpa
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mahasiswa List -->
                    <div class="space-y-2">
                        @foreach ($mahasiswaList as $index => $mahasiswa)
                            <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-blue-300 transition">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-800 text-xs font-bold mr-3">
                                            {{ $index + 1 }}
                                        </span>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900">{{ $mahasiswa->Nama }}</p>
                                            <p class="text-xs text-gray-500">NIM: {{ $mahasiswa->NIM }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio" name="presensi[{{ $mahasiswa->NIM }}]" value="Hadir"
                                            class="sr-only peer" required>
                                        <span
                                            class="px-4 py-2 text-sm font-medium rounded-lg border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-100 peer-checked:text-green-800 hover:bg-gray-50 transition">
                                            Hadir
                                        </span>
                                    </label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio" name="presensi[{{ $mahasiswa->NIM }}]" value="Izin"
                                            class="sr-only peer">
                                        <span
                                            class="px-4 py-2 text-sm font-medium rounded-lg border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-100 peer-checked:text-blue-800 hover:bg-gray-50 transition">
                                            Izin
                                        </span>
                                    </label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio" name="presensi[{{ $mahasiswa->NIM }}]" value="Sakit"
                                            class="sr-only peer">
                                        <span
                                            class="px-4 py-2 text-sm font-medium rounded-lg border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-100 peer-checked:text-yellow-800 hover:bg-gray-50 transition">
                                            Sakit
                                        </span>
                                    </label>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="radio" name="presensi[{{ $mahasiswa->NIM }}]" value="Alpa"
                                            class="sr-only peer">
                                        <span
                                            class="px-4 py-2 text-sm font-medium rounded-lg border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-100 peer-checked:text-red-800 hover:bg-gray-50 transition">
                                            Alpa
                                        </span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('dosen.presensi.index') }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-lg transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">
                            Simpan Presensi
                        </button>
                    </div>
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
    </form>

    <script>
        function setAllStatus(status) {
            const radios = document.querySelectorAll(`input[type="radio"][value="${status}"]`);
            radios.forEach(radio => {
                radio.checked = true;
            });
        }
    </script>
</x-admin-layout>
