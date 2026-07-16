<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkinExpert — Sistem Pakar Penyakit Kulit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-poppins bg-white text-gray-900">

    {{-- Navbar --}}
    <nav class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur border-b border-gray-200" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="/" class="flex items-center gap-2 font-bold text-sky-700 text-xl">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                SkinExpert
            </a>
            <div class="hidden md:flex items-center gap-6">
                <a href="#features" class="text-sm text-gray-600 hover:text-sky-700 transition">Fitur</a>
                <a href="#how-it-works" class="text-sm text-gray-600 hover:text-sky-700 transition">Cara Kerja</a>
                <a href="#diseases" class="text-sm text-gray-600 hover:text-sky-700 transition">Penyakit</a>
                <a href="#faq" class="text-sm text-gray-600 hover:text-sky-700 transition">FAQ</a>
                @auth
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="text-sm font-medium text-sky-700 hover:text-sky-900 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-sky-700 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-sky-600 hover:bg-sky-700 px-4 py-2 rounded-lg transition">Daftar Gratis</a>
                @endauth
            </div>
            <button @click="open = !open" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
        <div x-show="open" x-transition class="md:hidden px-4 pb-4 flex flex-col gap-3 border-t border-gray-100">
            <a href="#features" class="text-sm text-gray-600">Fitur</a>
            <a href="#how-it-works" class="text-sm text-gray-600">Cara Kerja</a>
            <a href="{{ route('login') }}" class="text-sm text-gray-600">Masuk</a>
            <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-sky-600 px-4 py-2 rounded-lg text-center">Daftar Gratis</a>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="pt-32 pb-20 bg-gradient-to-br from-sky-50 via-white to-blue-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-12">
            <div class="flex-1 text-center lg:text-left">
                <span class="inline-block mb-4 px-3 py-1 text-xs font-semibold text-sky-700 bg-sky-100 rounded-full">Berbasis Certainty Factor</span>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    Kenali Penyakit Kulit<br>
                    <span class="text-sky-600">Dengan Cepat & Akurat</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-xl mx-auto lg:mx-0">
                    SkinExpert membantu Anda mengidentifikasi kemungkinan penyakit kulit berdasarkan gejala yang dialami menggunakan metode kecerdasan buatan Certainty Factor.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl shadow-lg shadow-sky-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        Mulai Konsultasi
                    </a>
                    <a href="#how-it-works" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
                        Pelajari Lebih Lanjut
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </a>
                </div>
                <p class="mt-4 text-xs text-gray-400">* Hasil bersifat skrining, bukan pengganti diagnosis dokter.</p>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="relative w-80 h-80">
                    <div class="absolute inset-0 bg-sky-400 rounded-full opacity-10 animate-pulse"></div>
                    <div class="absolute inset-8 bg-sky-500 rounded-full opacity-20"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-40 h-40 text-sky-600 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-12 bg-sky-700">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @foreach([['10', 'Jenis Penyakit'], ['35', 'Gejala Teridentifikasi'], ['64+', 'Basis Aturan (Rule)'], ['CF', 'Metode Certainty Factor']] as [$num, $label])
                <div>
                    <p class="text-3xl font-bold text-white">{{ $num }}</p>
                    <p class="text-sky-200 text-sm mt-1">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Mengapa SkinExpert?</h2>
                <p class="text-gray-500 max-w-lg mx-auto">Platform skrining kulit yang didukung sistem pakar berbasis kecerdasan buatan.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['Cepat & Mudah', 'Isi checklist gejala dalam hitungan menit dan dapatkan hasil analisis instan.', 'M13 10V3L4 14h7v7l9-11h-7z'],
                    ['Berbasis Ilmiah', 'Menggunakan metode Certainty Factor yang diakui dalam pengembangan sistem pakar medis.', 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['Riwayat Lengkap', 'Simpan dan pantau semua hasil skrining sebelumnya kapan saja.', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                ] as [$title, $desc, $path])
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Cara Kerja</h2>
                <p class="text-gray-500 max-w-lg mx-auto">Tiga langkah sederhana untuk mendapatkan hasil skrining.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['1', 'Pilih Gejala', 'Centang gejala yang Anda rasakan dan tentukan tingkat keyakinan Anda (0–100%).'],
                    ['2', 'Proses CF', 'Sistem menghitung nilai Certainty Factor dari setiap kombinasi gejala dan penyakit.'],
                    ['3', 'Lihat Hasil', 'Dapatkan daftar kemungkinan penyakit beserta persentase keyakinan dan saran penanganan.'],
                ] as [$num, $title, $desc])
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-sky-600 text-white text-2xl font-bold flex items-center justify-center mx-auto mb-5 shadow-lg shadow-sky-200">{{ $num }}</div>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Diseases --}}
    <section id="diseases" class="py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Penyakit yang Dapat Diidentifikasi</h2>
                <p class="text-gray-500 max-w-lg mx-auto">SkinExpert dapat mengidentifikasi 10 jenis penyakit kulit umum.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach(['Dermatitis Atopik', 'Psoriasis', 'Acne Vulgaris', 'Tinea Corporis', 'Urtikaria', 'Scabies', 'Rosacea', 'Vitiligo', 'Herpes Zoster', 'Selulitis'] as $i => $disease)
                <div class="bg-white border border-gray-100 rounded-xl p-4 text-center shadow-sm hover:shadow-md hover:border-sky-200 transition group">
                    <div class="w-10 h-10 rounded-full bg-sky-50 group-hover:bg-sky-100 flex items-center justify-center mx-auto mb-3 text-sky-700 font-bold text-sm transition">
                        P{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                    <p class="text-sm font-medium text-gray-800">{{ $disease }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="py-20 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Pertanyaan Umum</h2>
            </div>
            <div class="space-y-4" x-data="{ active: null }">
                @foreach([
                    ['Apakah SkinExpert menggantikan dokter?', 'Tidak. SkinExpert adalah alat bantu skrining awal. Hasilnya bersifat edukatif dan tidak dapat menggantikan diagnosis dari dokter spesialis kulit (dermatologis).'],
                    ['Metode apa yang digunakan?', 'SkinExpert menggunakan metode Certainty Factor (CF), yaitu metode yang umum digunakan dalam sistem pakar untuk menangani ketidakpastian dalam proses inferensi.'],
                    ['Apakah data saya aman?', 'Ya. Data konsultasi Anda tersimpan dengan aman dan hanya dapat diakses oleh Anda sendiri dan administrator sistem.'],
                    ['Apakah layanan ini gratis?', 'Ya, SkinExpert sepenuhnya gratis untuk digunakan sebagai alat skrining awal.'],
                ] as $i => [$q, $a])
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                    <button @click="active = active === {{ $i }} ? null : {{ $i }}" class="w-full flex items-center justify-between px-6 py-4 text-left font-medium text-gray-900 hover:bg-gray-50 transition">
                        {{ $q }}
                        <svg class="w-5 h-5 text-gray-400 transition-transform" :class="active === {{ $i }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === {{ $i }}" x-transition class="px-6 pb-4 text-sm text-gray-600 leading-relaxed">{{ $a }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 bg-sky-700">
        <div class="max-w-3xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Mulai Skrining?</h2>
            <p class="text-sky-200 mb-8">Daftar gratis dan mulai konsultasi pertama Anda sekarang.</p>
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-sky-700 font-bold rounded-xl shadow-lg hover:bg-sky-50 transition">
                Daftar & Mulai Konsultasi
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-10 text-sm text-center">
        <p class="font-semibold text-white mb-1">SkinExpert</p>
        <p>Sistem Pakar Penyakit Kulit &mdash; Berbasis Certainty Factor</p>
        <p class="mt-2 text-xs text-gray-600">Disclaimer: Hasil bersifat skrining dan tidak menggantikan diagnosis dokter.</p>
    </footer>

</body>
</html>
