<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-900">{{ __('Profile') }}</h2>
    <p class="mt-1 text-sm text-gray-600">{{ __('Kelola informasi akun dan data profil Anda.') }}</p>
</div>

@if (session('status') === 'profile-updated')
    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
        <span class="font-medium">{{ __('Saved.') }}</span>
    </div>
@endif
@if (session('status') === 'password-updated')
    <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
        <span class="font-medium">{{ __('Password saved.') }}</span>
    </div>
@endif

<div class="space-y-6 max-w-3xl">
    {{-- Data profil sesuai role --}}
    @if($user->role === 'dosen')
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">{{ __('Data Dosen') }}</h3>
                <p class="mt-0.5 text-sm text-gray-600">{{ __('Data profil dosen yang terhubung dengan akun Anda.') }}</p>
            </div>
            <div class="p-6">
                @if($user->dosen)
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">NIP</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 font-mono">{{ $user->dosen->NIP }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama lengkap</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->dosen->Nama }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->dosen->Alamat }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->dosen->Nohp }}</dd>
                        </div>
                    </dl>
                    <p class="mt-4 text-xs text-gray-500">{{ __('Perubahan data dosen (NIP, nama, alamat, dll.) dapat dilakukan oleh administrator.') }}</p>
                @else
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                        <p class="font-medium">{{ __('Data profil dosen belum diisi.') }}</p>
                        <p class="mt-1">{{ __('Akun Anda (role dosen) belum terhubung ke data dosen. Hubungi administrator untuk mengisi data NIP, nama, dan profil lainnya.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if($user->role === 'mahasiswa')
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">{{ __('Data Mahasiswa') }}</h3>
                <p class="mt-0.5 text-sm text-gray-600">{{ __('Data profil mahasiswa yang terhubung dengan akun Anda.') }}</p>
            </div>
            <div class="p-6">
                @if($user->mahasiswa)
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">NIM</dt>
                            <dd class="mt-0.5 text-sm text-gray-900 font-mono">{{ $user->mahasiswa->NIM }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama lengkap</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->mahasiswa->Nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Semester</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->mahasiswa->Semester }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Golongan (Kelas)</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->mahasiswa->golongan?->nama_Gol ?? $user->mahasiswa->id_Gol ?? '-' }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->mahasiswa->Alamat }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">No. HP</dt>
                            <dd class="mt-0.5 text-sm text-gray-900">{{ $user->mahasiswa->Nohp }}</dd>
                        </div>
                    </dl>
                    <p class="mt-4 text-xs text-gray-500">{{ __('Perubahan data mahasiswa (NIM, nama, golongan, dll.) dapat dilakukan oleh administrator.') }}</p>
                @else
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-800">
                        <p class="font-medium">{{ __('Data profil mahasiswa belum diisi.') }}</p>
                        <p class="mt-1">{{ __('Akun Anda (role mahasiswa) belum terhubung ke data mahasiswa. Hubungi administrator untuk mengisi data NIM, nama, golongan, dan profil lainnya.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if($user->role === 'admin')
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">{{ __('Profil Akun') }}</h3>
                <p class="mt-0.5 text-sm text-gray-600">{{ __('Anda login sebagai Administrator.') }}</p>
            </div>
        </div>
    @endif

    {{-- Informasi akun (nama & email) --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Kata sandi --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Hapus akun --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
