<x-guest-layout>
<div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 w-full">

    {{-- Logo --}}
    <div class="flex items-center gap-3 mb-7">
        <div class="w-12 h-12 shrink-0">
            <svg viewBox="0 0 100 100" class="w-full h-full">
                <defs>
                    <linearGradient id="hexVerify" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#22D3EE;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0C4A6E;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M50 5 L88 27.5 L88 72.5 L50 95 L12 72.5 L12 27.5 Z"
                      stroke="url(#hexVerify)" stroke-width="3.5" fill="none"/>
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

    <div class="mb-6">
        <div class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">Verifikasi Email</h1>
        <p class="text-gray-500 text-sm mt-2 leading-relaxed">
            Terima kasih telah mendaftar! Silakan verifikasi alamat email Anda dengan mengklik link yang kami kirimkan.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 flex items-start gap-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p>Link verifikasi baru telah dikirim ke email Anda.</p>
        </div>
    @endif

    <div class="flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="w-full bg-gradient-to-r from-sky-600 to-sky-700 hover:from-sky-700 hover:to-sky-800 text-white font-semibold py-2.5 rounded-xl transition-all text-sm shadow-lg shadow-sky-500/25">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium py-2.5 rounded-xl transition text-sm">
                Keluar
            </button>
        </form>
    </div>
</div>
</x-guest-layout>
