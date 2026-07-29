<x-guest-layout>
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 w-full">

    {{-- Logo --}}
    <div class="flex items-center gap-3 mb-7">
        <div class="w-12 h-12 shrink-0">
            <svg viewBox="0 0 100 100" class="w-full h-full">
                <defs>
                    <linearGradient id="hexLogin" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#22D3EE;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0C4A6E;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M50 5 L88 27.5 L88 72.5 L50 95 L12 72.5 L12 27.5 Z"
                      stroke="url(#hexLogin)" stroke-width="3.5" fill="none"/>
                <path d="M18 50 L34 50 L39 39 L44 61 L50 43 L56 50 L82 50"
                      stroke="#0EA5E9" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                <circle cx="50" cy="33" r="7.5" fill="#0C4A6E"/>
                <path d="M37 68 Q37 54 50 54 Q63 54 63 68"
                      stroke="#0C4A6E" stroke-width="3.5" fill="none" stroke-linecap="round"/>
            </svg>
        </div>
        <div>
            <div class="text-xl font-bold leading-none">
                <span class="text-sky-950">SKIN</span><span class="text-sky-500">EXPERT</span>
            </div>
            <div class="text-gray-400 text-xs tracking-wider mt-0.5">SISTEM PAKAR PENYAKIT KULIT</div>
        </div>
    </div>

    {{-- Heading --}}
    <div class="mb-7">
        <h1 class="text-2xl font-bold text-gray-900">Selamat Datang Kembali</h1>
        <p class="text-gray-500 text-sm mt-1">Masuk untuk melanjutkan konsultasi Anda</p>
    </div>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-5 flex items-center gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('status') }}
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus autocomplete="username"
                    placeholder="nama@email.com"
                    class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition {{ $errors->get('email') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
                >
            </div>
            @foreach ($errors->get('email') as $message)
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @endforeach
        </div>

        {{-- Password --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4.5 h-4.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                    placeholder="••••••••"
                    class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition {{ $errors->get('password') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
                >
            </div>
            @foreach ($errors->get('password') as $message)
                <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ $message }}
                </p>
            @endforeach
        </div>

        {{-- Remember & Forgot --}}
        <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500">
                <span class="text-sm text-gray-600">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-sky-600 hover:text-sky-700">
                    Lupa password?
                </a>
            @endif
        </div>

        {{-- Submit --}}
        <button
            type="submit"
            class="w-full mt-2 bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-semibold py-2.5 rounded-xl transition-all duration-200 shadow-lg shadow-sky-500/25 hover:shadow-sky-600/35 text-sm"
        >
            Masuk ke Akun
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-100"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-3 bg-white text-gray-400 text-xs">Belum punya akun?</span>
        </div>
    </div>

    {{-- Register link --}}
    <a href="{{ route('register') }}" class="block w-full text-center border-2 border-sky-500 text-sky-600 hover:bg-sky-50 font-semibold py-2.5 rounded-xl transition text-sm">
        Buat Akun Baru
    </a>

    {{-- Disclaimer --}}
    <p class="mt-6 text-xs text-gray-400 text-center leading-relaxed">
        Hasil konsultasi bersifat skrining awal dan tidak menggantikan diagnosis dokter.
    </p>
</div>
</x-guest-layout>
