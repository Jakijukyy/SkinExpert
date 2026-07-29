@extends('layouts.app')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Profile header card --}}
    <div class="bg-gradient-to-r from-sky-600 to-sky-800 rounded-2xl p-6 text-white shadow-md">
        <div class="flex items-center gap-5">
            <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-3xl font-bold shrink-0 border-2 border-white/40">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                <p class="text-sky-200 text-sm mt-0.5">{{ $user->email }}</p>
                <div class="flex items-center gap-3 mt-2">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                        {{ $user->role === 'admin' ? 'bg-amber-400/20 text-amber-200 border border-amber-400/30' : 'bg-white/10 text-sky-100 border border-white/20' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $user->role === 'admin' ? 'bg-amber-300' : 'bg-green-300' }}"></span>
                        {{ $user->role === 'admin' ? 'Administrator' : 'Pengguna' }}
                    </span>
                    <span class="text-sky-300 text-xs">Bergabung {{ $user->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
            <div class="hidden sm:flex gap-6 text-center shrink-0">
                <div>
                    <p class="text-2xl font-bold">{{ $totalDiagnoses }}</p>
                    <p class="text-sky-300 text-xs mt-0.5">Konsultasi</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-bold">{{ round($avgCf * 100, 1) }}%</p>
                    <p class="text-sky-300 text-xs mt-0.5">Rata-rata CF</p>
                </div>
                <div class="w-px bg-white/20"></div>
                <div>
                    <p class="text-2xl font-bold">{{ $mostFrequent?->total ?? 0 }}</p>
                    <p class="text-sky-300 text-xs mt-0.5">Penyakit Umum</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('status') === 'profile-updated')
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3000)"
            class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-800">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Profil berhasil diperbarui.
        </div>
    @endif
    @if(session('status') === 'password-updated')
        <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=>show=false,3000)"
            class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-xl text-sm text-green-800">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Password berhasil diperbarui.
        </div>
    @endif

    {{-- Main grid --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Left column: forms --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Update profile info --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-sky-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm">Informasi Profil</h3>
                        <p class="text-xs text-gray-400">Perbarui nama dan alamat email akun Anda</p>
                    </div>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update password --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-violet-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 text-sm">Ubah Password</h3>
                        <p class="text-xs text-gray-400">Pastikan akun Anda menggunakan password yang kuat</p>
                    </div>
                </div>
                <div class="p-6">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete account --}}
            <div class="bg-white rounded-2xl border border-red-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-red-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-red-700 text-sm">Hapus Akun</h3>
                        <p class="text-xs text-gray-400">Hapus akun secara permanen beserta semua data</p>
                    </div>
                </div>
                <div class="p-6">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>

        {{-- Right column: stats & activity --}}
        <div class="space-y-6">

            {{-- Stats cards --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-semibold text-gray-900 text-sm mb-4">Statistik Konsultasi</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-sky-50 rounded-xl">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-sky-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <span class="text-sm text-gray-700">Total Konsultasi</span>
                        </div>
                        <span class="text-lg font-bold text-sky-700">{{ $totalDiagnoses }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-violet-50 rounded-xl">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-violet-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                            <span class="text-sm text-gray-700">Rata-rata CF</span>
                        </div>
                        <span class="text-lg font-bold text-violet-700">{{ round($avgCf * 100, 1) }}%</span>
                    </div>
                    @if($mostFrequent && $mostFrequent->penyakit)
                    <div class="flex items-center justify-between p-3 bg-amber-50 rounded-xl">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Penyakit Terbanyak</p>
                                <p class="text-sm font-medium text-gray-800 leading-tight">{{ $mostFrequent->penyakit->nama }}</p>
                            </div>
                        </div>
                        <span class="text-sm font-bold text-amber-700">{{ $mostFrequent->total }}x</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Monthly chart --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                <h3 class="font-semibold text-gray-900 text-sm mb-4">Aktivitas 6 Bulan Terakhir</h3>
                @if($monthlyData->isEmpty())
                    <div class="py-6 text-center text-gray-400 text-sm">
                        <svg class="w-10 h-10 mx-auto mb-2 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Belum ada aktivitas
                    </div>
                @else
                    <canvas id="profileChart" height="160"></canvas>
                @endif
            </div>

            {{-- Recent activity --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-semibold text-gray-900 text-sm">Konsultasi Terbaru</h3>
                    <a href="{{ route('consultation.history') }}" class="text-xs text-sky-600 hover:underline">Lihat semua</a>
                </div>
                @if($recentDiagnoses->isEmpty())
                    <div class="px-5 py-8 text-center text-gray-400 text-sm">Belum ada konsultasi.</div>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach($recentDiagnoses as $d)
                        <a href="{{ route('consultation.result', $d) }}" class="flex items-center gap-3 px-5 py-3 hover:bg-gray-50 transition">
                            <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-xs shrink-0">
                                {{ $d->penyakit?->kode ?? '?' }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $d->penyakit?->nama ?? 'Tidak teridentifikasi' }}</p>
                                <p class="text-xs text-gray-400">{{ $d->tanggal->format('d M Y') }}</p>
                            </div>
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full shrink-0
                                {{ $d->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($d->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ round($d->cf_tertinggi * 100, 1) }}%
                            </span>
                        </a>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>{{-- end right column --}}
    </div>{{-- end grid --}}

</div>
@endsection

@push('scripts')
@if($monthlyData->isNotEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const months = @json($monthlyData->map(fn($r) => \Carbon\Carbon::create($r->year, $r->month)->translatedFormat('M Y')));
const counts  = @json($monthlyData->pluck('total'));
new Chart(document.getElementById('profileChart'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Konsultasi',
            data: counts,
            backgroundColor: 'rgba(14,165,233,0.15)',
            borderColor: 'rgba(14,165,233,0.8)',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f1f5f9' } },
            x: { grid: { display: false } }
        }
    }
});
</script>
@endif
@endpush
