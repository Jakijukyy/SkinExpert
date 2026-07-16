@extends('layouts.app')
@section('title', 'Detail Diagnosa #' . $diagnosa->id)
@section('page-title', 'Detail Diagnosa #' . $diagnosa->id)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <a href="{{ route('admin.diagnosa.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <a href="{{ route('admin.diagnosa.pdf', $diagnosa) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Download PDF
        </a>
    </div>

    {{-- Info --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <h3 class="font-semibold text-gray-900 mb-4">Informasi Diagnosa</h3>
        <dl class="grid sm:grid-cols-2 gap-4 text-sm">
            <div><dt class="text-gray-400 text-xs uppercase tracking-wider mb-1">Pengguna</dt><dd class="font-medium text-gray-900">{{ $diagnosa->user?->name ?? 'Guest' }}</dd></div>
            <div><dt class="text-gray-400 text-xs uppercase tracking-wider mb-1">Email</dt><dd class="text-gray-700">{{ $diagnosa->user?->email ?? '-' }}</dd></div>
            <div><dt class="text-gray-400 text-xs uppercase tracking-wider mb-1">Tanggal</dt><dd class="text-gray-700">{{ $diagnosa->tanggal->format('d M Y, H:i') }}</dd></div>
            <div>
                <dt class="text-gray-400 text-xs uppercase tracking-wider mb-1">Hasil Tertinggi</dt>
                <dd class="font-semibold text-sky-700">{{ $diagnosa->penyakit?->nama ?? '-' }} ({{ round($diagnosa->cf_tertinggi * 100, 1) }}%)</dd>
            </div>
        </dl>
    </div>

    {{-- Full ranking --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Peringkat Semua Penyakit</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($diagnosa->hasil_json as $i => $r)
            <div class="px-6 py-3 flex items-center gap-4">
                <span class="text-base font-bold {{ $i === 0 ? 'text-sky-600' : 'text-gray-200' }} w-6">{{ $i + 1 }}</span>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-sm font-medium text-gray-800">{{ $r['nama'] }}</span>
                        <span class="text-sm font-bold {{ $i === 0 ? 'text-sky-700' : 'text-gray-600' }}">{{ $r['persentase'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5">
                        <div class="h-1.5 rounded-full {{ $i === 0 ? 'bg-sky-500' : 'bg-gray-300' }}" style="width: {{ $r['persentase'] }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Gejala --}}
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Gejala yang Dilaporkan</h3>
        </div>
        <div class="px-6 py-4 flex flex-wrap gap-2">
            @foreach($diagnosa->details as $detail)
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-sky-50 text-sky-800 text-xs font-medium rounded-full">
                {{ $detail->gejala->nama }}
                <span class="text-sky-500 font-bold">{{ round($detail->cf_user * 100) }}%</span>
            </span>
            @endforeach
        </div>
    </div>

</div>
@endsection
