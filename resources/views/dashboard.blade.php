@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome banner --}}
    <div class="bg-gradient-to-r from-sky-600 to-sky-800 rounded-2xl p-6 text-white shadow-md">
        <h2 class="text-xl font-bold mb-1">Selamat datang, {{ auth()->user()->name }}!</h2>
        <p class="text-sky-100 text-sm">Gunakan SkinExpert untuk melakukan skrining penyakit kulit berdasarkan gejala yang Anda rasakan.</p>
        <a href="{{ route('consultation.create') }}" class="mt-4 inline-flex items-center gap-2 bg-white text-sky-700 font-semibold text-sm px-5 py-2.5 rounded-lg hover:bg-sky-50 transition shadow">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Mulai Konsultasi Baru
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid sm:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $totalDiagnoses }}</p>
                <p class="text-sm text-gray-500">Total Konsultasi</p>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-900">{{ $recentDiagnoses->count() }}</p>
                <p class="text-sm text-gray-500">Konsultasi Terbaru</p>
            </div>
        </div>
    </div>

    {{-- Recent diagnoses --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Riwayat Konsultasi Terbaru</h3>
            <a href="{{ route('consultation.history') }}" class="text-sm text-sky-600 hover:underline">Lihat semua</a>
        </div>
        @if($recentDiagnoses->isEmpty())
            <div class="px-6 py-12 text-center">
                <svg class="w-12 h-12 text-gray-200 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                <p class="text-gray-500 text-sm">Belum ada konsultasi. <a href="{{ route('consultation.create') }}" class="text-sky-600 hover:underline">Mulai konsultasi pertama Anda.</a></p>
            </div>
        @else
            <div class="divide-y divide-gray-50">
                @foreach($recentDiagnoses as $diagnosa)
                <a href="{{ route('consultation.result', $diagnosa) }}" class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold text-xs shrink-0">
                            {{ $diagnosa->penyakit?->kode ?? '?' }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 text-sm">{{ $diagnosa->penyakit?->nama ?? 'Tidak teridentifikasi' }}</p>
                            <p class="text-xs text-gray-400">{{ $diagnosa->tanggal->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-2.5 py-1 text-xs font-semibold rounded-full
                            {{ $diagnosa->cf_tertinggi >= 0.7 ? 'bg-red-100 text-red-700' : ($diagnosa->cf_tertinggi >= 0.4 ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                            {{ round($diagnosa->cf_tertinggi * 100, 1) }}%
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Disclaimer --}}
    <div class="flex gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p><strong>Disclaimer:</strong> Hasil konsultasi SkinExpert bersifat skrining awal dan tidak dapat menggantikan diagnosis dokter. Segera konsultasikan ke dokter spesialis kulit (dermatologis) untuk penanganan lebih lanjut.</p>
    </div>

</div>
@endsection
