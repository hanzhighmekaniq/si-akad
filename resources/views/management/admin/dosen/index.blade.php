<x-admin-layout>
    <x-slot name="title">Manajemen Dosen - SI Akademik</x-slot>

    <div class="mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Manajemen Dosen</h2>
        <p class="mt-1 text-sm text-gray-600">Kelola data dosen dan hubungkan dengan akun user (login)</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <form method="GET" action="{{ route('admin.dosen.index') }}" class="flex gap-4">
            <div class="flex-1">
                <label for="search" class="block mb-2 text-sm font-medium text-gray-900">Cari Dosen</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="NIP, nama, atau no HP...">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Cari</button>
                <a href="{{ route('admin.dosen.index') }}" class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">Reset</a>
            </div>
        </form>
    </div>

    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-600">Total: <span class="font-semibold">{{ $dosen->total() }}</span> dosen</p>
        <a href="{{ route('admin.dosen.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">Tambah Dosen</a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">NIP</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Akun User (Login)</th>
                        <th scope="col" class="px-6 py-3">No. HP</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dosen as $d)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ ($dosen->currentPage() - 1) * $dosen->perPage() + $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">{{ $d->NIP }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $d->Nama }}</td>
                            <td class="px-6 py-4">
                                @if($d->user)
                                    <span class="text-gray-900">{{ $d->user->name }}</span>
                                    <span class="block text-xs text-gray-500">{{ $d->user->email }}</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Belum dihubungkan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $d->Nohp }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.dosen.show', $d->NIP) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200">Lihat</a>
                                    <a href="{{ route('admin.dosen.edit', $d->NIP) }}" class="font-medium text-blue-600 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('admin.dosen.destroy', $d->NIP) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dosen {{ $d->Nama }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 hover:text-red-700">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <p class="text-lg font-medium">Tidak ada data dosen</p>
                                <p class="text-sm">Tambahkan dosen baru dan hubungkan dengan user role dosen</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($dosen->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">{{ $dosen->links() }}</div>
        @endif
    </div>
</x-admin-layout>
