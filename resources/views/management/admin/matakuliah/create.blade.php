<x-admin-layout>
    <x-slot name="title">Tambah Mata Kuliah - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.matakuliah.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Mata Kuliah</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Tambahkan mata kuliah baru ke dalam sistem</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.matakuliah.store') }}" class="space-y-6">
            @csrf

            <!-- Kode MK -->
            <div>
                <label for="Kode_mk" class="block mb-2 text-sm font-medium text-gray-900">
                    Kode Mata Kuliah <span class="text-red-600">*</span>
                </label>
                <input type="text" name="Kode_mk" id="Kode_mk" value="{{ old('Kode_mk') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono @error('Kode_mk') border-red-500 @enderror"
                    placeholder="Contoh: TIF101" required>
                @error('Kode_mk')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Kode unik untuk mata kuliah (huruf besar)</p>
            </div>

            <!-- Nama MK -->
            <div>
                <label for="Nama_mk" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Mata Kuliah <span class="text-red-600">*</span>
                </label>
                <input type="text" name="Nama_mk" id="Nama_mk" value="{{ old('Nama_mk') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Nama_mk') border-red-500 @enderror"
                    placeholder="Contoh: Pemrograman Web" required>
                @error('Nama_mk')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- SKS -->
                <div>
                    <label for="sks" class="block mb-2 text-sm font-medium text-gray-900">
                        SKS (Satuan Kredit Semester) <span class="text-red-600">*</span>
                    </label>
                    <select name="sks" id="sks"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('sks') border-red-500 @enderror"
                        required>
                        <option value="">Pilih SKS</option>
                        @for ($i = 1; $i <= 6; $i++)
                            <option value="{{ $i }}" {{ old('sks') == $i ? 'selected' : '' }}>
                                {{ $i }} SKS
                            </option>
                        @endfor
                    </select>
                    @error('sks')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Semester -->
                <div>
                    <label for="semester" class="block mb-2 text-sm font-medium text-gray-900">
                        Semester <span class="text-red-600">*</span>
                    </label>
                    <select name="semester" id="semester"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('semester') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Semester</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                    @error('semester')
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
                            <li>Kode mata kuliah harus unik dan tidak boleh sama dengan yang sudah ada</li>
                            <li>SKS berkisar antara 1-6 sesuai standar kurikulum</li>
                            <li>Semester menunjukkan pada semester berapa mata kuliah ini diajarkan</li>
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
                    Simpan Mata Kuliah
                </button>
                <a href="{{ route('admin.matakuliah.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
