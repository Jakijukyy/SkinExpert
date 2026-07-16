@extends('layouts.app')

@section('title', 'Riwayat Konsultasi')
@section('page-title', 'Riwayat Konsultasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total <strong class="text-gray-800">{{ $diagnoses->total() }}</strong> konsultasi</p>
        <a href="{{ route('consultation.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Konsultasi Baru
        </a>
    </div>

    @if($diagnoses->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-16 text-center">
            <svg class="w-14 h-14 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            <p class="text-gray-500 mb-4">Belum ada riwayat konsultasi.</p>
            <a href="{{ route('consultation.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-lg transition">Mulai Konsultasi Pertama</a>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="divide-y divide-gray-50">
                @foreach($diagnoses as $diagnosa)
                <a href="{{ route('consultation.result', $diagnosa) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-xs shrink-0 group-hover:bg-sky-200 transition">
                            {{ $diagnosa->penyakit?->kode ?? '?' }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">{{ $diagnosa->penyakit?->nama ?? 'Tidak teridentifikasi' }}</p>
                            <p class="text-xs text-gray-400">{{ $diagnosa->tanggal->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                            {{ $diagnosa->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($diagnosa->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                            {{ round($diagnosa->cf_tertinggi * 100, 1) }}%
                        </span>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-sky-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div>{{ $diagnoses->links() }}</div>
    @endif

</div>
@endsection
