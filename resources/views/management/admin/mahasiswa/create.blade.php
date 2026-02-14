<x-admin-layout>
    <x-slot name="title">Tambah Mahasiswa - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4 4 4" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Tambah Mahasiswa</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Tambahkan data mahasiswa dan (opsional) hubungkan dengan akun user untuk login</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('admin.mahasiswa.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="NIM" class="block mb-2 text-sm font-medium text-gray-900">NIM <span class="text-red-600">*</span></label>
                <input type="text" name="NIM" id="NIM" value="{{ old('NIM') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono @error('NIM') border-red-500 @enderror"
                    placeholder="Contoh: 20210001234" required>
                @error('NIM')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900">Akun User (Login)</label>
                <select name="user_id" id="user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('user_id') border-red-500 @enderror">
                    <option value="">— Tidak dihubungkan (isi nanti) —</option>
                    @foreach($usersMahasiswa as $u)
                        <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}
                            @if(in_array($u->id, $linkedUserIds)) disabled @endif>
                            {{ $u->name }} ({{ $u->email }})
                            @if(in_array($u->id, $linkedUserIds)) — sudah punya profil mahasiswa @endif
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Pilih user dengan role mahasiswa agar mahasiswa ini bisa login ke portal mahasiswa.</p>
            </div>

            <div>
                <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900">Nama <span class="text-red-600">*</span></label>
                <input type="text" name="Nama" id="Nama" value="{{ old('Nama') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Nama') border-red-500 @enderror"
                    placeholder="Nama lengkap mahasiswa" required>
                @error('Nama')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="Semester" class="block mb-2 text-sm font-medium text-gray-900">Semester <span class="text-red-600">*</span></label>
                    <input type="number" name="Semester" id="Semester" value="{{ old('Semester', 1) }}" min="1" max="14"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Semester') border-red-500 @enderror"
                        required>
                    @error('Semester')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="id_Gol" class="block mb-2 text-sm font-medium text-gray-900">Golongan (Kelas) <span class="text-red-600">*</span></label>
                    <select name="id_Gol" id="id_Gol"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('id_Gol') border-red-500 @enderror"
                        required>
                        <option value="">— Pilih Golongan —</option>
                        @foreach($golongan as $g)
                            <option value="{{ $g->id_Gol }}" {{ old('id_Gol') == $g->id_Gol ? 'selected' : '' }}>{{ $g->id_Gol }} - {{ $g->nama_Gol }}</option>
                        @endforeach
                    </select>
                    @error('id_Gol')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="Alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat <span class="text-red-600">*</span></label>
                <textarea name="Alamat" id="Alamat" rows="3"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Alamat') border-red-500 @enderror"
                    placeholder="Alamat lengkap" required>{{ old('Alamat') }}</textarea>
                @error('Alamat')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="Nohp" class="block mb-2 text-sm font-medium text-gray-900">No. HP <span class="text-red-600">*</span></label>
                <input type="text" name="Nohp" id="Nohp" value="{{ old('Nohp') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('Nohp') border-red-500 @enderror"
                    placeholder="08xxxxxxxxxx" required>
                @error('Nohp')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Simpan Mahasiswa</button>
                <a href="{{ route('admin.mahasiswa.index') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Batal</a>
            </div>
        </form>
    </div>
</x-admin-layout>
