@extends('layouts.app')
@section('title', 'Semua Diagnosa')
@section('page-title', 'Semua Diagnosa')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total <strong class="text-gray-800">{{ $diagnoses->total() }}</strong> diagnosa</p>
        <a href="{{ route('admin.diagnosa.pdf-all') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Export Semua PDF
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Pengguna</th>
                        <th class="px-4 py-3 text-left">Penyakit Tertinggi</th>
                        <th class="px-4 py-3 text-left">CF</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($diagnoses as $d)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $d->id }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $d->user?->name ?? 'Guest' }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $d->penyakit?->nama ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $d->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($d->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                {{ round($d->cf_tertinggi * 100, 1) }}%
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500 text-xs">{{ $d->tanggal->format('d M Y, H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.diagnosa.show', $d) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-sky-700 bg-sky-50 hover:bg-sky-100 rounded-lg transition">Detail</a>
                                <a href="{{ route('admin.diagnosa.pdf', $d) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition">PDF</a>
                                <form action="{{ route('admin.diagnosa.destroy', $d) }}" method="POST" onsubmit="return confirm('Hapus data diagnosa ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-lg transition">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">Belum ada data diagnosa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>{{ $diagnoses->links() }}</div>
</div>
@endsection
