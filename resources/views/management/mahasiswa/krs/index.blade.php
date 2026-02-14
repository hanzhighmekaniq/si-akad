co<x-mahasiswa-layout>
    <x-slot name="title">Kartu Rencana Studi (KRS) - Student Portal</x-slot>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kartu Rencana Studi (KRS)</h1>
                <p class="text-gray-600 text-sm mt-1">{{ $mahasiswa->Nama }} - {{ $mahasiswa->NIM }} - Semester {{ $mahasiswa->Semester }}</p>
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

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-3">
        <!-- Total Mata Kuliah -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total Mata Kuliah</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $krs->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Total SKS -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Total SKS</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalSks }}</p>
                </div>
            </div>
        </div>

        <!-- Semester Aktif -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-indigo-600 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 font-medium">Semester Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $mahasiswa->Semester }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($krs->count() > 0)
        <!-- KRS Table -->
        <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
            <!-- Table Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h2 class="text-xl font-bold text-white">Daftar Mata Kuliah</h2>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 bg-white bg-opacity-20 rounded-lg text-sm font-semibold text-white">
                        {{ $krs->count() }} Mata Kuliah
                    </span>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs uppercase bg-gray-50 text-gray-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold">No</th>
                            <th scope="col" class="px-6 py-4 font-bold">Kode MK</th>
                            <th scope="col" class="px-6 py-4 font-bold">Nama Mata Kuliah</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center">SKS</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center">Semester</th>
                            <th scope="col" class="px-6 py-4 font-bold">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($krs as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-lg font-semibold text-xs">
                                        {{ $item->matakuliah->Kode_mk }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-gray-900">{{ $item->matakuliah->Nama_mk }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-lg font-bold text-sm">
                                        {{ $item->matakuliah->sks }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-800 rounded-lg font-semibold text-xs">
                                        Semester {{ $item->matakuliah->semester }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->matakuliah->pengampu->isNotEmpty())
                                        <div class="flex flex-col gap-1">
                                            @foreach($item->matakuliah->pengampu as $pengampu)
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span class="text-gray-700">{{ $pengampu->dosen->Nama }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs italic">Belum ditentukan</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 border-t-2 border-gray-300">
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-right font-bold text-gray-900">Total SKS:</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-bold text-lg">
                                    {{ $totalSks }}
                                </span>
                            </td>
                            <td colspan="2" class="px-6 py-4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- KRS Summary by Semester -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($krsBySemester as $semester => $items)
                <div class="bg-white rounded-lg shadow border border-gray-200 p-5">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Semester {{ $semester }}</h3>
                        <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-blue-800 rounded-lg font-semibold text-xs">
                            {{ $items->count() }} MK
                        </span>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Jumlah Mata Kuliah:</span>
                            <span class="font-semibold text-gray-900">{{ $items->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Total SKS:</span>
                            <span class="font-bold text-blue-600">{{ $items->sum(function($item) { return $item->matakuliah->sks ?? 0; }) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow border border-gray-200 p-12 text-center">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada KRS</h3>
            <p class="text-gray-600 text-sm">Anda belum mengambil mata kuliah untuk semester ini. Hubungi bagian akademik untuk informasi lebih lanjut.</p>
        </div>
    @endif

    <!-- Info Footer -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <h4 class="text-sm font-semibold text-blue-900 mb-1">Informasi KRS</h4>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>• KRS (Kartu Rencana Studi) adalah daftar mata kuliah yang Anda ambil pada semester ini</li>
                    <li>• Pastikan total SKS sesuai dengan ketentuan maksimal SKS per semester</li>
                    <li>• Untuk perubahan KRS, hubungi bagian akademik pada masa KRS berlangsung</li>
                </ul>
            </div>
        </div>
    </div>
</x-mahasiswa-layout>
