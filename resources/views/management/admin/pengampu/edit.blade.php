<x-admin-layout>
    <x-slot name="title">Edit Pengampu - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.pengampu.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Edit Pengampu</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Ubah daftar mata kuliah yang diampu oleh dosen</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.pengampu.update', $dosen->NIP) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">Dosen</label>
                <div class="p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <span class="font-medium text-gray-900">{{ $dosen->Nama }}</span>
                    <span class="block text-sm text-gray-500">NIP: {{ $dosen->NIP }}</span>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    Mata Kuliah yang diampu
                </label>
                <p class="text-xs text-gray-500 mb-3">Centang mata kuliah yang diampu dosen ini. Boleh tidak memilih jika akan menghapus semua.</p>
                <div class="border border-gray-200 rounded-lg p-4 max-h-80 overflow-y-auto space-y-2">
                    @foreach ($matakuliahList as $mk)
                        <label class="flex items-center gap-3 p-2 rounded hover:bg-gray-50 cursor-pointer">
                            <input type="checkbox" name="Kode_mk[]" value="{{ $mk->Kode_mk }}"
                                {{ in_array($mk->Kode_mk, old('Kode_mk', $currentKodeMk)) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="font-mono font-semibold text-gray-900">{{ $mk->Kode_mk }}</span>
                            <span class="text-gray-600">{{ $mk->Nama_mk }}</span>
                            <span class="text-xs text-gray-400">(S{{ $mk->semester }}, {{ $mk->sks }} SKS)</span>
                        </label>
                    @endforeach
                </div>
                @if ($errors->has('Kode_mk.*'))
                    <p class="mt-2 text-sm text-red-600">{{ $errors->first('Kode_mk.*') }}</p>
                @endif
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pengampu.index') }}"
                    class="text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
