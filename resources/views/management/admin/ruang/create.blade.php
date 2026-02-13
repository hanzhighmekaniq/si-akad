<x-admin-layout>
    <x-slot name="title">Tambah Ruangan - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.ruang.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Ruangan</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Tambahkan ruangan perkuliahan baru</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.ruang.store') }}" class="space-y-6">
            @csrf

            <!-- ID Ruang -->
            <div>
                <label for="id_ruang" class="block mb-2 text-sm font-medium text-gray-900">
                    ID Ruangan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="id_ruang" id="id_ruang" value="{{ old('id_ruang') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono @error('id_ruang') border-red-500 @enderror"
                    placeholder="Contoh: R101" required>
                @error('id_ruang')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">ID unik untuk ruangan (huruf dan angka)</p>
            </div>

            <!-- Nama Ruang -->
            <div>
                <label for="nama_ruang" class="block mb-2 text-sm font-medium text-gray-900">
                    Nama Ruangan <span class="text-red-600">*</span>
                </label>
                <input type="text" name="nama_ruang" id="nama_ruang" value="{{ old('nama_ruang') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nama_ruang') border-red-500 @enderror"
                    placeholder="Contoh: Ruang Kuliah 101" required>
                @error('nama_ruang')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                            <li>ID ruangan harus unik dan tidak boleh sama dengan yang sudah ada</li>
                            <li>Gunakan format yang konsisten, misalnya R101, LAB201, dll</li>
                            <li>Nama ruangan sebaiknya deskriptif dan mudah dikenali</li>
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
                    Simpan Ruangan
                </button>
                <a href="{{ route('admin.ruang.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
