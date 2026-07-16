@extends('layouts.app')

@section('title', 'Hasil Diagnosa')
@section('page-title', 'Hasil Konsultasi')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Disclaimer --}}
    <div class="flex gap-3 p-4 bg-amber-50 border border-amber-200 rounded-xl text-sm text-amber-800">
        <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.07 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p><strong>Disclaimer:</strong> Hasil ini adalah skrining awal dan <strong>bukan diagnosis medis</strong>. Segera konsultasikan ke dokter spesialis kulit untuk penanganan yang tepat.</p>
    </div>

    {{-- Main result card --}}
    @php $p = $diagnosa->penyakit; $cf = $diagnosa->cf_tertinggi; @endphp
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-sky-600 to-sky-800 px-6 py-5 text-white">
            <p class="text-sky-200 text-xs font-medium uppercase tracking-wider mb-1">Hasil Analisis Tertinggi</p>
            <h2 class="text-2xl font-bold">{{ $p?->nama ?? 'Tidak Teridentifikasi' }}</h2>
            <div class="flex items-center gap-3 mt-3">
                <div class="flex-1 bg-sky-700 rounded-full h-2.5 overflow-hidden">
                    <div class="h-full bg-white rounded-full transition-all" style="width: {{ $cf * 100 }}%"></div>
                </div>
                <span class="text-lg font-bold">{{ round($cf * 100, 1) }}%</span>
            </div>
            <p class="text-sky-200 text-xs mt-1">Nilai Certainty Factor: {{ $diagnosa->cf_tertinggi }}</p>
        </div>

        @if($p)
        <div class="p-6 space-y-5">
            <div>
                <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Deskripsi</h3>
                <p class="text-sm text-gray-700 leading-relaxed">{{ $p->deskripsi }}</p>
            </div>
            <div class="grid sm:grid-cols-3 gap-4">
                <div class="bg-red-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-red-600 uppercase tracking-wider mb-2">Penyebab</p>
                    <p class="text-sm text-red-900 leading-relaxed">{{ $p->penyebab }}</p>
                </div>
                <div class="bg-sky-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-sky-600 uppercase tracking-wider mb-2">Solusi</p>
                    <p class="text-sm text-sky-900 leading-relaxed">{{ $p->solusi }}</p>
                </div>
                <div class="bg-green-50 rounded-xl p-4">
                    <p class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-2">Pencegahan</p>
                    <p class="text-sm text-green-900 leading-relaxed">{{ $p->pencegahan }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- Full ranking --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Peringkat Semua Kemungkinan</h3>
            <p class="text-xs text-gray-400 mt-0.5">Berdasarkan perhitungan Certainty Factor dari gejala yang dipilih</p>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($diagnosa->hasil_json as $i => $result)
            <div class="px-6 py-4 flex items-center gap-4">
                <span class="text-lg font-bold {{ $i === 0 ? 'text-sky-600' : 'text-gray-300' }} w-8 text-center shrink-0">#{{ $i + 1 }}</span>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1.5">
                        <div>
                            <span class="text-xs font-mono text-gray-400">{{ $result['kode'] }}</span>
                            <span class="ml-2 text-sm font-semibold text-gray-900">{{ $result['nama'] }}</span>
                        </div>
                        <span class="text-sm font-bold {{ $i === 0 ? 'text-sky-700' : 'text-gray-600' }}">{{ $result['persentase'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="h-1.5 rounded-full {{ $i === 0 ? 'bg-sky-500' : 'bg-gray-300' }}" style="width: {{ $result['persentase'] }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Gejala yang dipilih --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Gejala yang Dilaporkan</h3>
        </div>
        <div class="px-6 py-4 flex flex-wrap gap-2">
            @foreach($diagnosa->details as $detail)
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sky-50 text-sky-800 text-xs font-medium rounded-full border border-sky-100">
                {{ $detail->gejala->nama }}
                <span class="text-sky-500 font-semibold">{{ round($detail->cf_user * 100) }}%</span>
            </span>
            @endforeach
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('consultation.create') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-xl transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Konsultasi Baru
        </a>
        <a href="{{ route('consultation.history') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Riwayat
        </a>
        <a href="{{ route('dashboard') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">
            Dashboard
        </a>
    </div>

</div>
@endsection
