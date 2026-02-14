<x-admin-layout>
    <x-slot name="title">Tambah Pengampu - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.pengampu.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Pengampu</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Tetapkan mata kuliah yang diampu oleh dosen</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.pengampu.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="NIP" class="block mb-2 text-sm font-medium text-gray-900">
                    Dosen <span class="text-red-600">*</span>
                </label>
                <select name="NIP" id="NIP" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('NIP') border-red-500 @enderror">
                    <option value="">Pilih Dosen</option>
                    @foreach ($dosenList as $d)
                        <option value="{{ $d->NIP }}" {{ old('NIP', $selectedNip) == $d->NIP ? 'selected' : '' }}>
                            {{ $d->Nama }} ({{ $d->NIP }})
                        </option>
                    @endforeach
                </select>
                @error('NIP')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Mata Kuliah yang diampu <span class="text-red-600">*</span>
                </label>
                <p class="text-xs text-gray-500 mb-3">Pilih satu atau lebih mata kuliah. Yang sudah diampu dosen ini bisa tetap dicentang (akan diabaikan).</p>
                <div class="border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto space-y-2">
                    @foreach ($matakuliahList as $mk)
                        <label class="flex items-center gap-3 p-2 rounded hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="Kode_mk[]" value="{{ $mk->Kode_mk }}"
                                {{ in_array($mk->Kode_mk, old('Kode_mk', [])) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="font-mono font-semibold text-gray-900">{{ $mk->Kode_mk }}</span>
                            <span class="text-gray-600">{{ $mk->Nama_mk }}</span>
                            <span class="text-xs text-gray-400">(S{{ $mk->semester }}, {{ $mk->sks }} SKS)</span>
                        </label>
                    @endforeach
                </div>
                @error('Kode_mk')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @if ($errors->has('Kode_mk.*'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('Kode_mk.*') }}</p>
                @endif
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan Pengampu
                </button>
                <a href="{{ route('admin.pengampu.index') }}"
                    class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
