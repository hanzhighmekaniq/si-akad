<section class="space-y-6">
    <header class="pb-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">
            {{ __('Hapus Akun') }}
        </h2>
        <p class="mt-0.5 text-sm text-gray-600">
            {{ __('Setelah akun dihapus, semua data akan hilang permanen. Unduh data yang ingin disimpan sebelum menghapus akun.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">
                {{ __('Yakin ingin menghapus akun?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Semua data akan hilang permanen. Masukkan kata sandi untuk konfirmasi.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-full max-w-md"
                    placeholder="{{ __('Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button type="button" x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button class="ms-0">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
