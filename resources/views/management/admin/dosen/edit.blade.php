<x-admin-layout>
    <x-slot name="title">Edit Dosen - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.dosen.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Edit Dosen</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Update data dosen: {{ $dosen->Nama }}</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.dosen.update', $dosen->NIP) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="NIP" class="block mb-2 text-sm font-medium text-gray-900">NIP <span class="text-red-600">*</span></label>
                <input type="text" name="NIP" id="NIP" value="{{ old('NIP', $dosen->NIP) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono @error('NIP') border-red-500 @enderror"
                    required>
                @error('NIP')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900">Akun User (Login)</label>
                <select name="user_id" id="user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('user_id') border-red-500 @enderror">
                    <option value="">— Tidak dihubungkan —</option>
                    @foreach($usersDosen as $u)
                        <option value="{{ $u->id }}" {{ old('user_id', $dosen->user_id) == $u->id ? 'selected' : '' }}>
                            {{ $u->name }} ({{ $u->email }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900">Nama <span class="text-red-600">*</span></label>
                <input type="text" name="Nama" id="Nama" value="{{ old('Nama', $dosen->Nama) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Nama') border-red-500 @enderror"
                    required>
                @error('Nama')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat <span class="text-red-600">*</span></label>
                <textarea name="Alamat" id="Alamat" rows="3"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Alamat') border-red-500 @enderror"
                    required>{{ old('Alamat', $dosen->Alamat) }}</textarea>
                @error('Alamat')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Nohp" class="block mb-2 text-sm font-medium text-gray-900">No. HP <span class="text-red-600">*</span></label>
                <input type="text" name="Nohp" id="Nohp" value="{{ old('Nohp', $dosen->Nohp) }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Nohp') border-red-500 @enderror"
                    required>
                @error('Nohp')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update Dosen
                </button>
                <a href="{{ route('admin.dosen.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-admin-layout>
