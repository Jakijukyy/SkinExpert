<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SkinExpert') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-poppins antialiased">
    <div class="min-h-screen flex">

        {{-- Left side - Decorative brand panel --}}
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-sky-500 via-sky-700 to-sky-950 relative overflow-hidden flex-col justify-center">
            {{-- Background decorative shapes --}}
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-sky-400/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 right-10 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>

            {{-- Brand content --}}
            <div class="relative z-10 px-16 text-white">
                {{-- Logo area --}}
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-16 h-16">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <defs>
                                <linearGradient id="hexSide" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:1" />
                                    <stop offset="100%" style="stop-color:#7DD3FC;stop-opacity:1" />
                                </linearGradient>
                            </defs>
                            <path d="M50 5 L88 27.5 L88 72.5 L50 95 L12 72.5 L12 27.5 Z"
                                  stroke="url(#hexSide)" stroke-width="3.5" fill="none"/>
                            <path d="M18 50 L34 50 L39 39 L44 61 L50 43 L56 50 L82 50"
                                  stroke="white" stroke-width="2.5" fill="none" stroke-linecap="round" opacity="0.95"/>
                            <circle cx="50" cy="33" r="7.5" fill="white" opacity="0.95"/>
                            <path d="M37 68 Q37 54 50 54 Q63 54 63 68"
                                  stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round" opacity="0.95"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-bold leading-none tracking-wide">
                            <span class="text-white">SKIN</span><span class="text-sky-300">EXPERT</span>
                        </div>
                        <div class="text-sky-300 text-xs tracking-widest mt-1 font-medium">SISTEM PAKAR PENYAKIT KULIT</div>
                    </div>
                </div>

                {{-- Headline --}}
                <h2 class="text-4xl font-extrabold leading-tight mb-4">
                    Identifikasi Penyakit Kulit<br>
                    <span class="text-sky-300">Lebih Cepat & Akurat</span>
                </h2>
                <p class="text-sky-100 text-base leading-relaxed mb-10 max-w-md">
                    Didukung metode Certainty Factor, SkinExpert membantu skrining penyakit kulit berdasarkan gejala yang Anda rasakan.
                </p>

                {{-- Feature list --}}
                <div class="space-y-4">
                    @foreach([
                        ['M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', '10 jenis penyakit kulit teridentifikasi'],
                        ['M13 10V3L4 14h7v7l9-11h-7z', 'Analisis instan dengan Certainty Factor'],
                        ['M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'Riwayat konsultasi tersimpan aman'],
                    ] as [$path, $text])
                    <div class="flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center shrink-0 backdrop-blur-sm">
                            <svg class="w-4.5 h-4.5 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $path }}"/>
                            </svg>
                        </div>
                        <span class="text-sky-50 text-sm">{{ $text }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Bottom note --}}
            <div class="relative z-10 px-16 mt-16">
                <p class="text-sky-400 text-xs">* Hasil skrining tidak menggantikan diagnosis dokter.</p>
            </div>
        </div>

        {{-- Right side - Auth form --}}
        <div class="flex-1 flex items-center justify-center px-6 py-12 bg-gray-50">
            <div class="w-full max-w-[420px]">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
