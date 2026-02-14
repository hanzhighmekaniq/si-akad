<x-guest-layout>
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Konfirmasi Password</h2>
        <p class="text-sm text-gray-600">Ini adalah area aman. Silakan konfirmasi password Anda untuk melanjutkan.</p>
    </div>

    <div class="mb-6 text-sm text-gray-600 bg-amber-50 border border-amber-200 rounded-lg p-4">
        <p>Untuk keamanan, mohon masukkan password Anda kembali.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="text-gray-700 font-medium" />
            <x-text-input id="password" class="block mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                          type="password" name="password" required autocomplete="current-password"
                          placeholder="Masukkan password Anda" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                Konfirmasi
            </button>
        </div>
    </form>
</x-guest-layout>
