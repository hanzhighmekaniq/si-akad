@if(auth()->user()->role === 'mahasiswa')
    <x-mahasiswa-layout>
        <x-slot name="title">Profile - SI Akademik</x-slot>
        @include('profile.partials.edit-content')
    </x-mahasiswa-layout>
@else
    <x-admin-layout>
        <x-slot name="title">Profile - SI Akademik</x-slot>
        @include('profile.partials.edit-content')
    </x-admin-layout>
@endif
