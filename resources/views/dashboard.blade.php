@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
<div class="space-y-6">

{{-- ═══ WELCOME BANNER ═══ --}}
<div class="bg-gradient-to-r from-sky-600 to-sky-800 rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
    <div class="absolute -right-8 -top-8 w-40 h-40 bg-white/5 rounded-full"></div>
    <div class="absolute -right-4 bottom-0 w-24 h-24 bg-white/5 rounded-full"></div>
    <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-4">
        <div class="w-14 h-14 rounded-2xl bg-white/15 backdrop-blur flex items-center justify-center text-2xl font-bold shrink-0 border border-white/20">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <div class="flex-1">
            <p class="text-sky-200 text-xs font-medium uppercase tracking-wider">Selamat datang kembali</p>
            <h2 class="text-xl font-bold mt-0.5">{{ $user->name }}</h2>
            <p class="text-sky-200 text-sm mt-0.5">{{ $user->email }}</p>
        </div>
        <a href="{{ route('consultation.create') }}"
           class="shrink-0 inline-flex items-center gap-2 bg-white text-sky-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-sky-50 transition shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Konsultasi Baru
        </a>
    </div>
</div>

{{-- ═══ STATS ROW ═══ --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    {{-- Total konsultasi --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Total</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $totalDiagnoses }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Konsultasi</p>
    </div>

    {{-- Bulan ini --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            @if($lastMonth > 0)
                @php $diff = $thisMonth - $lastMonth; @endphp
                <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $diff >= 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                    {{ $diff >= 0 ? '+' : '' }}{{ $diff }}
                </span>
            @endif
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $thisMonth }}</p>
        <p class="text-sm text-gray-500 mt-0.5">Bulan Ini</p>
    </div>

    {{-- Rata-rata CF --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <span class="text-xs font-medium text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">CF</span>
        </div>
        <p class="text-3xl font-bold text-gray-900">{{ $avgCf }}%</p>
        <p class="text-sm text-gray-500 mt-0.5">Rata-rata CF</p>
    </div>

    {{-- Penyakit terbanyak --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <span class="text-xs font-medium text-rose-600 bg-rose-50 px-2 py-0.5 rounded-full">Top</span>
        </div>
        <p class="text-sm font-bold text-gray-900 leading-tight">
            {{ $topDisease?->penyakit?->nama ?? '—' }}
        </p>
        <p class="text-sm text-gray-500 mt-0.5">
            {{ $topDisease ? $topDisease->total . 'x terdiagnosa' : 'Belum ada data' }}
        </p>
    </div>
</div>

{{-- ═══ MAIN GRID: chart kiri + sidebar kanan ═══ --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Chart 7 hari --}}
    <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="font-semibold text-gray-900">Aktivitas Konsultasi</h3>
                <p class="text-xs text-gray-400 mt-0.5">7 hari terakhir</p>
            </div>
            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                <span class="w-3 h-3 rounded-sm bg-sky-400 inline-block"></span>
                Konsultasi
            </div>
        </div>
        @if(array_sum($chartData) > 0)
            <canvas id="activityChart" height="120"></canvas>
        @else
            <div class="flex flex-col items-center justify-center py-10 text-gray-400">
                <svg class="w-14 h-14 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-sm font-medium">Belum ada konsultasi dalam 7 hari terakhir</p>
                <a href="{{ route('consultation.create') }}" class="mt-3 text-sm text-sky-600 hover:underline font-medium">Mulai konsultasi sekarang →</a>
            </div>
        @endif
    </div>

    {{-- Sidebar: profil ringkas + best result --}}
    <div class="space-y-4">

        {{-- Info akun --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-900 text-sm mb-4">Informasi Akun</h3>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-sky-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="border-t border-gray-50 pt-3 space-y-2.5 text-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Role
                        </span>
                        <span class="font-medium px-2 py-0.5 rounded-full text-xs
                            {{ $user->role === 'admin' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Bergabung
                        </span>
                        <span class="font-medium text-gray-700">{{ $user->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Terakhir aktif
                        </span>
                        <span class="font-medium text-gray-700">{{ $user->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                   class="mt-1 block w-full text-center text-sm font-medium text-sky-600 hover:text-sky-700 border border-sky-200 hover:border-sky-400 py-2 rounded-xl transition">
                    Edit Profil
                </a>
            </div>
        </div>

        {{-- Best diagnosis --}}
        @if($bestDiagnosis)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-semibold text-gray-900 text-sm mb-3">Hasil Terbaik</h3>
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-sky-600 flex items-center justify-center text-white font-bold text-xs shrink-0">
                    {{ $bestDiagnosis->penyakit?->kode ?? '?' }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $bestDiagnosis->penyakit?->nama ?? '—' }}</p>
                    <p class="text-xs text-gray-400">{{ $bestDiagnosis->tanggal->format('d M Y') }}</p>
                </div>
            </div>
            <div class="mt-3">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs text-gray-500">Certainty Factor</span>
                    <span class="text-sm font-bold text-sky-700">{{ round($bestDiagnosis->cf_tertinggi * 100, 1) }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2">
                    <div class="h-2 bg-sky-500 rounded-full transition-all"
                         style="width: {{ round($bestDiagnosis->cf_tertinggi * 100, 1) }}%"></div>
                </div>
            </div>
            <a href="{{ route('consultation.result', $bestDiagnosis) }}"
               class="mt-3 block text-center text-xs text-sky-600 hover:underline font-medium">
                Lihat detail →
            </a>
        </div>
        @endif

    </div>{{-- end sidebar --}}
</div>{{-- end main grid --}}

{{-- ═══ RIWAYAT KONSULTASI TERBARU ═══ --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <div>
            <h3 class="font-semibold text-gray-900">Riwayat Konsultasi Terbaru</h3>
            <p class="text-xs text-gray-400 mt-0.5">5 konsultasi terakhir Anda</p>
        </div>
        <a href="{{ route('consultation.history') }}"
           class="inline-flex items-center gap-1 text-sm text-sky-600 hover:text-sky-700 font-medium">
            Lihat semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    @if($recentDiagnoses->isEmpty())
        <div class="px-6 py-14 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <p class="text-gray-600 font-medium mb-1">Belum ada konsultasi</p>
            <p class="text-gray-400 text-sm mb-4">Mulai konsultasi pertama untuk mendeteksi penyakit kulit Anda.</p>
            <a href="{{ route('consultation.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Mulai Konsultasi Pertama
            </a>
        </div>
    @else
        {{-- Desktop table --}}
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Penyakit</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Certainty Factor</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentDiagnoses as $diagnosa)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-xs shrink-0">
                                    {{ $diagnosa->penyakit?->kode ?? '?' }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">{{ $diagnosa->penyakit?->nama ?? 'Tidak teridentifikasi' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            <p>{{ $diagnosa->tanggal->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $diagnosa->tanggal->format('H:i') }} WIB</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-24 bg-gray-100 rounded-full h-1.5">
                                    <div class="h-1.5 rounded-full
                                        {{ $diagnosa->cf_tertinggi >= 0.7 ? 'bg-red-500' : ($diagnosa->cf_tertinggi >= 0.4 ? 'bg-yellow-500' : 'bg-green-500') }}"
                                         style="width: {{ round($diagnosa->cf_tertinggi * 100) }}%">
                                    </div>
                                </div>
                                <span class="font-semibold text-gray-800">{{ round($diagnosa->cf_tertinggi * 100, 1) }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                                {{ $diagnosa->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($diagnosa->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ $diagnosa->cf_tertinggi >= 0.7 ? 'Tinggi' : ($diagnosa->cf_tertinggi >= 0.4 ? 'Sedang' : 'Rendah') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('consultation.result', $diagnosa) }}"
                               class="inline-flex items-center gap-1 text-xs font-medium text-sky-600 hover:text-sky-700 bg-sky-50 hover:bg-sky-100 px-3 py-1.5 rounded-lg transition">
                                Detail
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Mobile card list --}}
        <div class="sm:hidden divide-y divide-gray-50">
            @foreach($recentDiagnoses as $diagnosa)
            <a href="{{ route('consultation.result', $diagnosa) }}" class="flex items-center justify-between px-5 py-4 hover:bg-gray-50 transition">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-xs shrink-0">
                        {{ $diagnosa->penyakit?->kode ?? '?' }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-900 text-sm">{{ $diagnosa->penyakit?->nama ?? 'Tidak teridentifikasi' }}</p>
                        <p class="text-xs text-gray-400">{{ $diagnosa->tanggal->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full shrink-0
                    {{ $diagnosa->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($diagnosa->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                    {{ round($diagnosa->cf_tertinggi * 100, 1) }}%
                </span>
            </a>
            @endforeach
        </div>
    @endif
</div>

{{-- ═══ DISCLAIMER ═══ --}}
<div class="flex gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
    <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/>
    </svg>
    <p><strong>Disclaimer:</strong> Hasil konsultasi SkinExpert bersifat skrining awal dan tidak dapat menggantikan diagnosis dokter. Segera konsultasikan ke dokter spesialis kulit (dermatologis) untuk penanganan lebih lanjut.</p>
</div>

</div>{{-- end outer space-y-6 --}}
@endsection

@push('scripts')
@if(array_sum($chartData) > 0)
<script>
new Chart(document.getElementById('activityChart'), {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Konsultasi',
            data: @json($chartData),
            backgroundColor: function(context) {
                const value = context.raw;
                return value > 0 ? 'rgba(14,165,233,0.18)' : 'rgba(226,232,240,0.5)';
            },
            borderColor: function(context) {
                const value = context.raw;
                return value > 0 ? 'rgba(14,165,233,0.85)' : 'rgba(203,213,225,0.8)';
            },
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ctx => ` ${ctx.raw} konsultasi`
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1, color: '#94a3b8', font: { size: 11 } },
                grid: { color: '#f1f5f9' },
                border: { display: false }
            },
            x: {
                ticks: { color: '#94a3b8', font: { size: 12 } },
                grid: { display: false },
                border: { display: false }
            }
        }
    }
});
</script>
@endif
@endpush
