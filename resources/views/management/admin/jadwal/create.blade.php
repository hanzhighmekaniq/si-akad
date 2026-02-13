<x-admin-layout>
    <x-slot name="title">Tambah Jadwal Akademik - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.jadwal.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Jadwal Akademik</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Buat jadwal perkuliahan baru</p>
    </div>

    <!-- Conflict Error -->
    @if ($errors->has('conflict'))
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="font-medium">{{ $errors->first('conflict') }}</span>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.jadwal.store') }}" class="space-y-6">
            @csrf

            <!-- Hari -->
            <div>
                <label for="hari" class="block mb-2 text-sm font-medium text-gray-900">
                    Hari <span class="text-red-600">*</span>
                </label>
                <select name="hari" id="hari"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('hari') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Hari</option>
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                        <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>
                            {{ $hari }}
                        </option>
                    @endforeach
                </select>
                @error('hari')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mata Kuliah -->
            <div>
                <label for="Kode_mk" class="block mb-2 text-sm font-medium text-gray-900">
                    Mata Kuliah <span class="text-red-600">*</span>
                </label>
                <select name="Kode_mk" id="Kode_mk"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Kode_mk') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach($matakuliahs as $mk)
                        <option value="{{ $mk->Kode_mk }}" {{ old('Kode_mk') == $mk->Kode_mk ? 'selected' : '' }}>
                            {{ $mk->Kode_mk }} - {{ $mk->Nama_mk }} ({{ $mk->sks }} SKS, Semester {{ $mk->semester }})
                        </option>
                    @endforeach
                </select>
                @error('Kode_mk')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ruangan -->
                <div>
                    <label for="id_ruang" class="block mb-2 text-sm font-medium text-gray-900">
                        Ruangan <span class="text-red-600">*</span>
                    </label>
                    <select name="id_ruang" id="id_ruang"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('id_ruang') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Ruangan</option>
                        @foreach($ruangs as $ruang)
                            <option value="{{ $ruang->id_ruang }}" {{ old('id_ruang') == $ruang->id_ruang ? 'selected' : '' }}>
                                {{ $ruang->nama_ruang }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_ruang')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Golongan -->
                <div>
                    <label for="id_Gol" class="block mb-2 text-sm font-medium text-gray-900">
                        Golongan <span class="text-red-600">*</span>
                    </label>
                    <select name="id_Gol" id="id_Gol"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('id_Gol') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Golongan</option>
                        @foreach($golongans as $gol)
                            <option value="{{ $gol->id_Gol }}" {{ old('id_Gol') == $gol->id_Gol ? 'selected' : '' }}>
                                {{ $gol->nama_Gol }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_Gol')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Info Box -->
            <div class="p-4 text-sm text-blue-800 rounded-lg bg-blue-50 border border-blue-200" role="alert">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <div>
                        <span class="font-medium">Informasi:</span>
                        <ul class="mt-1.5 list-disc list-inside">
                            <li>Sistem akan mengecek konflik ruangan pada hari yang sama</li>
                            <li>Pastikan mata kuliah sesuai dengan golongan yang dipilih</li>
                            <li>Satu ruangan hanya bisa digunakan satu kali per hari</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-4 h-4 inline-block mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.546.5a9.5 9.5 0 1 0 9.5 9.5 9.51 9.51 0 0 0-9.5-9.5ZM13.788 11h-3.242v3.242a1 1 0 1 1-2 0V11H5.304a1 1 0 0 1 0-2h3.242V5.758a1 1 0 0 1 2 0V9h3.242a1 1 0 1 1 0 2Z" />
                    </svg>
                    Simpan Jadwal
                </button>
                <a href="{{ route('admin.jadwal.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
