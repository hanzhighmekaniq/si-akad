<x-guest-layout>
    <!-- Page Title -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-1">Verifikasi Email</h2>
        <p class="text-sm text-gray-600">Terima kasih telah mendaftar! Silakan verifikasi email Anda terlebih dahulu.</p>
    </div>

    <div class="mb-6 text-sm text-gray-600 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <p>Link verifikasi telah dikirim ke email Anda. Jika tidak menerima email, silakan klik tombol di bawah untuk mengirim ulang.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-4">
            Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
        </div>
    @endif

    <div class="space-y-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-medium py-3 px-4 rounded-lg border border-gray-300 transition duration-200">
                Keluar
            </button>
        </form>
    </div>
</x-guest-layout>
