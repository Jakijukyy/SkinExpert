@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Admin')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@section('content')
<div class="space-y-6">

    {{-- Stats --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach([
            ['Penyakit', $totalPenyakit, 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'bg-sky-100 text-sky-600'],
            ['Gejala', $totalGejala, 'M4 6h16M4 10h16M4 14h16M4 18h16', 'bg-violet-100 text-violet-600'],
            ['Total User', $totalUser, 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'bg-emerald-100 text-emerald-600'],
            ['Total Diagnosa', $totalDiagnosa, 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'bg-amber-100 text-amber-600'],
        ] as [$label, $value, $path, $color])
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 {{ $color }} rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $path }}"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
                <p class="text-sm text-gray-500">{{ $label }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Chart --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Diagnosa 7 Hari Terakhir</h3>
            <canvas id="diagnosisChart" class="w-full" height="140"></canvas>
        </div>

        {{-- Top diseases --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Penyakit Terbanyak</h3>
            @forelse($topDiseases as $i => $item)
            <div class="flex items-center gap-3 mb-3">
                <span class="text-sm font-bold text-gray-400 w-4">{{ $i + 1 }}</span>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $item->penyakit?->nama ?? '-' }}</p>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mt-1">
                        <div class="h-1.5 bg-sky-500 rounded-full" style="width: {{ $topDiseases->max('total') > 0 ? round($item->total / $topDiseases->max('total') * 100) : 0 }}%"></div>
                    </div>
                </div>
                <span class="text-sm font-semibold text-gray-600">{{ $item->total }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400 py-4 text-center">Belum ada data diagnosa.</p>
            @endforelse
        </div>
    </div>

    {{-- Recent diagnoses table --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Diagnosa Terbaru</h3>
            <a href="{{ route('admin.diagnosa.index') }}" class="text-sm text-sky-600 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Pengguna</th>
                        <th class="px-6 py-3 text-left">Penyakit</th>
                        <th class="px-6 py-3 text-left">CF</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recentDiagnoses as $d)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3 font-medium text-gray-900">{{ $d->user?->name ?? 'Guest' }}</td>
                        <td class="px-6 py-3 text-gray-700">{{ $d->penyakit?->nama ?? '-' }}</td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $d->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($d->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ round($d->cf_tertinggi * 100, 1) }}%
                            </span>
                        </td>
                        <td class="px-6 py-3 text-gray-500">{{ $d->tanggal->format('d M Y') }}</td>
                        <td class="px-6 py-3">
                            <a href="{{ route('admin.diagnosa.show', $d) }}" class="text-xs text-sky-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada data diagnosa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
const labels = @json($chartData->keys());
const data   = @json($chartData->values());

new Chart(document.getElementById('diagnosisChart'), {
    type: 'bar',
    data: {
        labels,
        datasets: [{
            label: 'Jumlah Diagnosa',
            data,
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
@endpush
