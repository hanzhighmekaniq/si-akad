<x-admin-layout>
    <x-slot name="title">Edit Golongan - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.golongan.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Edit Golongan</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Update informasi golongan: {{ $golongan->nama_Gol }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.golongan.update', $golongan->id_Gol) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- ID Golongan -->
            <div>
                <label for="id_Gol" class="block mb-2 text-sm font-medium text-gray-900">
                    ID Golongan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="id_Gol" id="id_Gol" value="{{ old('id_Gol', $golongan->id_Gol) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono @error('id_Gol') border-red-500 @enderror"
                    placeholder="Contoh: TIF-A" required>
                @error('id_Gol')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">ID unik untuk golongan (huruf dan angka)</p>
            </div>

            <!-- Nama Golongan -->
            <div>
                <label for="nama_Gol" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Golongan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="nama_Gol" id="nama_Gol" value="{{ old('nama_Gol', $golongan->nama_Gol) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nama_Gol') border-red-500 @enderror"
                    placeholder="Contoh: Teknik Informatika - A" required>
                @error('nama_Gol')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Warning Box -->
            @if($golongan->mahasiswa()->count() > 0 || $golongan->jadwalAkademik()->count() > 0)
                <div class="p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 border border-yellow-200" role="alert">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-2 mt-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                        </svg>
                        <div>
                            <span class="font-medium">Peringatan!</span>
                            <p class="mt-1">Golongan ini sedang digunakan oleh:</p>
                            <ul class="mt-1.5 list-disc list-inside">
                                @if($golongan->mahasiswa()->count() > 0)
                                    <li>{{ $golongan->mahasiswa()->count() }} mahasiswa</li>
                                @endif
                                @if($golongan->jadwalAkademik()->count() > 0)
                                    <li>{{ $golongan->jadwalAkademik()->count() }} jadwal akademik</li>
                                @endif
                            </ul>
                            <p class="mt-1">Perubahan ID golongan dapat mempengaruhi data terkait.</p>
                        </div>
                    </div>
                </div>
            @endif

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
                            <li>ID golongan harus unik dan tidak boleh sama dengan yang sudah ada</li>
                            <li>Golongan digunakan untuk mengelompokkan mahasiswa dalam satu kelas</li>
                            <li>Setiap golongan akan memiliki jadwal perkuliahan tersendiri</li>
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
                            d="M18 2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2ZM2 18V7h6.7l.4-.409A4.309 4.309 0 0 1 15.753 7H18v11H2Z" />
                    </svg>
                    Update Golongan
                </button>
                <a href="{{ route('admin.golongan.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
