<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SkinExpert') — SkinExpert</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-poppins" x-data="{ sidebarOpen: false }">

    <div class="flex h-full">
        {{-- Sidebar --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 bg-gradient-to-b from-sky-700 to-sky-900 shadow-xl transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        >
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 py-4 border-b border-sky-600">
                <div class="w-9 h-9 shrink-0">
                    <svg viewBox="0 0 100 100" class="w-full h-full">
                        <defs>
                            <linearGradient id="hexSidebar" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#7DD3FC;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#FFFFFF;stop-opacity:0.9" />
                            </linearGradient>
                        </defs>
                        <path d="M50 5 L88 27.5 L88 72.5 L50 95 L12 72.5 L12 27.5 Z"
                              stroke="url(#hexSidebar)" stroke-width="3.5" fill="none"/>
                        <path d="M18 50 L34 50 L39 39 L44 61 L50 43 L56 50 L82 50"
                              stroke="white" stroke-width="2.5" fill="none" stroke-linecap="round" opacity="0.9"/>
                        <circle cx="50" cy="33" r="7.5" fill="white" opacity="0.95"/>
                        <path d="M37 68 Q37 54 50 54 Q63 54 63 68"
                              stroke="white" stroke-width="3.5" fill="none" stroke-linecap="round" opacity="0.95"/>
                    </svg>
                </div>
                <div>
                    <div class="font-bold text-base leading-tight">
                        <span class="text-white">SKIN</span><span class="text-sky-300">EXPERT</span>
                    </div>
                    <p class="text-sky-300 text-xs">Sistem Pakar Kulit</p>
                </div>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                @if(auth()->user()->isAdmin())
                    <p class="px-3 pt-2 pb-1 text-xs font-semibold text-sky-300 uppercase tracking-wider">Admin</p>
                    <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></x-slot>
                        Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.penyakit.index') }}" :active="request()->routeIs('admin.penyakit.*')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></x-slot>
                        Data Penyakit
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.gejala.index') }}" :active="request()->routeIs('admin.gejala.*')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></x-slot>
                        Data Gejala
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.rules.index') }}" :active="request()->routeIs('admin.rules.*')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></x-slot>
                        Basis Pengetahuan
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.diagnosa.index') }}" :active="request()->routeIs('admin.diagnosa.*')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></x-slot>
                        Semua Diagnosa
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></x-slot>
                        Manajemen User
                    </x-nav-link>
                @else
                    <p class="px-3 pt-2 pb-1 text-xs font-semibold text-sky-300 uppercase tracking-wider">Menu</p>
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></x-slot>
                        Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('consultation.create') }}" :active="request()->routeIs('consultation.create')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></x-slot>
                        Mulai Konsultasi
                    </x-nav-link>
                    <x-nav-link href="{{ route('consultation.history') }}" :active="request()->routeIs('consultation.history')">
                        <x-slot name="icon"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></x-slot>
                        Riwayat Diagnosa
                    </x-nav-link>
                @endif
            </nav>

            {{-- User info --}}
            <div class="px-4 py-4 border-t border-sky-600">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-sky-500 text-white font-semibold text-sm shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-sky-300 text-xs truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="mt-3 flex gap-2">
                    <a href="{{ route('profile.edit') }}" class="flex-1 text-center text-xs text-sky-200 hover:text-white py-1 px-2 rounded hover:bg-sky-600 transition">Profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full text-xs text-sky-200 hover:text-white py-1 px-2 rounded hover:bg-sky-600 transition">Keluar</button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Mobile overlay --}}
        <div
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/50 md:hidden"
        ></div>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0 md:pl-64">
            {{-- Top bar --}}
            <header class="sticky top-0 z-30 flex items-center gap-4 px-4 py-3 bg-white border-b border-gray-200 shadow-sm">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <h1 class="text-gray-800 font-semibold text-lg truncate">@yield('page-title', 'Dashboard')</h1>
                <div class="ml-auto flex items-center gap-2">
                    @if(auth()->user()->isAdmin())
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-sky-100 text-sky-800">Admin</span>
                    @endif
                </div>
            </header>

            {{-- Flash messages --}}
            <div class="px-6 pt-4">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        class="flex items-center gap-3 p-4 mb-0 text-sm text-green-800 bg-green-50 border border-green-200 rounded-lg">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('success') }}
                        <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                        class="flex items-center gap-3 p-4 mb-0 text-sm text-red-800 bg-red-50 border border-red-200 rounded-lg">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ session('error') }}
                        <button @click="show = false" class="ml-auto text-red-600 hover:text-red-800">&times;</button>
                    </div>
                @endif
            </div>

            {{-- Page content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
