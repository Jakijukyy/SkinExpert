<form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PATCH')

    {{-- Name --}}
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <input
                id="name" type="text" name="name"
                value="{{ old('name', $user->name) }}"
                required autofocus autocomplete="name"
                class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition {{ $errors->get('name') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
            >
        </div>
        @foreach($errors->get('name') as $msg)
            <p class="mt-1.5 text-xs text-red-600">{{ $msg }}</p>
        @endforeach
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <input
                id="email" type="email" name="email"
                value="{{ old('email', $user->email) }}"
                required autocomplete="username"
                class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition {{ $errors->get('email') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
            >
        </div>
        @foreach($errors->get('email') as $msg)
            <p class="mt-1.5 text-xs text-red-600">{{ $msg }}</p>
        @endforeach

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2 flex items-center gap-2 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <p class="text-xs text-amber-700">
                    Email belum diverifikasi.
                    <form method="POST" action="{{ route('verification.send') }}" class="inline">
                        @csrf
                        <button type="submit" class="underline font-medium hover:text-amber-900">Kirim ulang verifikasi.</button>
                    </form>
                </p>
            </div>
            @if (session('status') === 'verification-link-sent')
                <p class="mt-1.5 text-xs text-green-600">Link verifikasi baru telah dikirim.</p>
            @endif
        @endif
    </div>

    <div class="pt-1">
        <button type="submit"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Simpan Perubahan
        </button>
    </div>
</form>
