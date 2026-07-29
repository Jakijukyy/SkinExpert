<x-guest-layout>
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 w-full">

    {{-- Logo --}}
    <div class="flex items-center gap-3 mb-7">
        <div class="w-12 h-12 shrink-0">
            <svg viewBox="0 0 100 100" class="w-full h-full">
                <defs>
                    <linearGradient id="hexForgot" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#22D3EE;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0C4A6E;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M50 5 L88 27.5 L88 72.5 L50 95 L12 72.5 L12 27.5 Z"
                      stroke="url(#hexForgot)" stroke-width="3.5" fill="none"/>
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
    <div class="mb-6">
        <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Lupa Password?</h1>
        <p class="text-gray-500 text-sm mt-2 leading-relaxed">
            Tidak masalah. Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
        </p>
    </div>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="mb-5 flex items-start gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>{{ session('status') }}</p>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Alamat Email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required autofocus
                    placeholder="nama@email.com"
                    class="w-full pl-10 pr-4 py-2.5 text-sm border rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition {{ $errors->get('email') ? 'border-red-300 bg-red-50' : 'border-gray-200' }}"
                >
            </div>
            @foreach ($errors->get('email') as $message)
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @endforeach
        </div>

        <button
            type="submit"
            class="w-full bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-semibold py-2.5 rounded-xl transition-all duration-200 shadow-lg shadow-sky-500/25 text-sm"
        >
            Kirim Link Reset Password
        </button>
    </form>

    {{-- Back to login --}}
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-sm text-sky-600 hover:text-sky-700 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke halaman masuk
        </a>
    </div>
</div>
</x-guest-layout>
