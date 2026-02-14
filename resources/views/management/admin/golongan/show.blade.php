<x-admin-layout>
    <x-slot name="title">Golongan {{ $golongan->nama_Gol }} - SI Akademik</x-slot>

    <div class="mb-6">
        <div class="flex items-center gap-2 mb-2">
            <a href="{{ route('admin.golongan.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="text-3xl font-bold text-gray-900">Golongan {{ $golongan->nama_Gol }}</h2>
        </div>
        <p class="mt-1 text-sm text-gray-600">Kelola mahasiswa di kelas ini ({{ $golongan->id_Gol }})</p>
    </div>

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200">
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    {{-- Info Golongan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID Golongan</dt>
                    <dd class="mt-1 font-mono font-semibold text-gray-900">{{ $golongan->id_Gol }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama Golongan</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $golongan->nama_Gol }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jumlah Mahasiswa</dt>
                    <dd class="mt-1 font-medium text-gray-900">{{ $golongan->mahasiswa->count() }} orang</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jadwal</dt>
                    <dd class="mt-1 text-gray-900">{{ $golongan->jadwal_akademik_count }} jadwal</dd>
                </div>
            </dl>
            <a href="{{ route('admin.golongan.edit', $golongan->id_Gol) }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                Edit Golongan
            </a>
        </div>
    </div>

    {{-- Tambah Mahasiswa ke Golongan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Tambah Mahasiswa ke Golongan Ini</h3>
        @if ($mahasiswaLain->isEmpty())
            <p class="text-sm text-gray-500">Semua mahasiswa sudah berada di suatu golongan. Tidak ada yang bisa ditambahkan.</p>
        @else
            <form method="POST" action="{{ route('admin.golongan.add-mahasiswa', $golongan->id_Gol) }}" class="space-y-4">
                @csrf
                <p class="text-sm text-gray-600">Pilih mahasiswa yang saat ini di golongan lain untuk dipindahkan ke <strong>{{ $golongan->nama_Gol }}</strong>:</p>
                <div class="mb-3">
                    <label for="search-mahasiswa" class="sr-only">Cari mahasiswa</label>
                    <input type="text" id="search-mahasiswa" placeholder="Cari NIM atau nama mahasiswa..."
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div id="mahasiswa-list" class="border border-gray-200 rounded-lg p-4 max-h-60 overflow-y-auto space-y-2">
                    @foreach ($mahasiswaLain as $m)
                        <label class="mahasiswa-item flex items-center gap-3 p-2 rounded hover:bg-gray-50 cursor-pointer"
                            data-nim="{{ strtolower($m->NIM) }}"
                            data-nama="{{ strtolower($m->Nama) }}">
                            <input type="checkbox" name="NIM[]" value="{{ $m->NIM }}"
                                class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                            <span class="font-mono font-medium text-gray-900">{{ $m->NIM }}</span>
                            <span class="text-gray-700">{{ $m->Nama }}</span>
                            <span class="text-xs text-gray-500">({{ $m->golongan->nama_Gol ?? '-' }}, S{{ $m->Semester }})</span>
                        </label>
                    @endforeach
                </div>
                <p id="mahasiswa-no-result" class="hidden text-sm text-gray-500 py-2">Tidak ada mahasiswa yang cocok dengan pencarian.</p>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 text-sm font-medium rounded-lg px-4 py-2">
                    Tambahkan ke Golongan Ini
                </button>
            </form>
        @endif
    </div>

    {{-- Daftar Mahasiswa di Golongan --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <h3 class="px-6 py-4 text-lg font-semibold text-gray-900 border-b border-gray-200">
            Daftar Mahasiswa ({{ $golongan->mahasiswa->count() }})
        </h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">NIM</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3 text-center">Semester</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($golongan->mahasiswa as $m)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-mono font-semibold text-gray-900">{{ $m->NIM }}</td>
                            <td class="px-6 py-4">{{ $m->Nama }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Semester {{ $m->Semester }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($golonganLain->isNotEmpty())
                                    <form action="{{ route('admin.golongan.pindahkan-mahasiswa', $golongan->id_Gol) }}" method="POST" class="inline flex items-center gap-2">
                                        @csrf
                                        <input type="hidden" name="NIM" value="{{ $m->NIM }}">
                                        <select name="id_Gol_tujuan" class="text-sm border border-gray-300 rounded-lg px-2 py-1.5 focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pindahkan ke...</option>
                                            @foreach ($golonganLain as $g)
                                                <option value="{{ $g->id_Gol }}">{{ $g->nama_Gol }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="text-sm font-medium text-blue-600 hover:text-blue-700">Pindahkan</button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <p class="font-medium">Belum ada mahasiswa di golongan ini</p>
                                <p class="text-sm mt-1">Gunakan form di atas untuk menambahkan mahasiswa dari golongan lain.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (!$mahasiswaLain->isEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchEl = document.getElementById('search-mahasiswa');
            var listEl = document.getElementById('mahasiswa-list');
            var noResultEl = document.getElementById('mahasiswa-no-result');
            if (!searchEl || !listEl) return;
            searchEl.addEventListener('input', function() {
                var q = (this.value || '').trim().toLowerCase();
                var items = listEl.querySelectorAll('.mahasiswa-item');
                var visible = 0;
                items.forEach(function(label) {
                    var nim = label.getAttribute('data-nim') || '';
                    var nama = label.getAttribute('data-nama') || '';
                    var match = !q || nim.indexOf(q) !== -1 || nama.indexOf(q) !== -1;
                    label.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
                if (noResultEl) noResultEl.classList.toggle('hidden', visible > 0 || !q);
            });
        });
    </script>
    @endif
</x-admin-layout>
