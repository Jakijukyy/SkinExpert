@extends('layouts.app')

@section('title', 'Konsultasi')
@section('page-title', 'Mulai Konsultasi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6" x-data="consultation()">

    {{-- Info banner --}}
    <div class="bg-sky-50 border border-sky-200 rounded-xl p-5 flex gap-3">
        <svg class="w-5 h-5 text-sky-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="text-sm text-sky-800">
            <p class="font-semibold mb-1">Petunjuk Pengisian</p>
            <p>Centang gejala yang Anda rasakan, lalu geser slider untuk menentukan <strong>tingkat keyakinan</strong> Anda (0% = tidak yakin, 100% = sangat yakin). Pilih minimal 1 gejala.</p>
        </div>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
            <p class="text-sm font-semibold text-red-800 mb-2">Terjadi kesalahan:</p>
            <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('consultation.store') }}" method="POST" id="consultationForm">
        @csrf

        {{-- Counter --}}
        <div class="flex items-center justify-between mb-3">
            <p class="text-sm font-medium text-gray-700">Daftar Gejala <span class="text-gray-400">({{ $gejalas->count() }} gejala)</span></p>
            <span class="text-sm font-semibold text-sky-700" x-text="selectedCount + ' gejala dipilih'"></span>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm divide-y divide-gray-50">
            @foreach($gejalas as $gejala)
            <div x-data="{ checked: false, cf: 0.8 }" class="px-5 py-4">
                <div class="flex items-start gap-4">
                    {{-- Checkbox --}}
                    <div class="flex items-center mt-0.5">
                        <input
                            type="checkbox"
                            id="gejala_check_{{ $gejala->id }}"
                            x-model="checked"
                            @change="onCheck(checked)"
                            class="w-4 h-4 rounded border-gray-300 text-sky-600 focus:ring-sky-500 cursor-pointer"
                        >
                    </div>
                    <div class="flex-1">
                        <label for="gejala_check_{{ $gejala->id }}" class="flex items-center gap-2 cursor-pointer">
                            <span class="inline-block text-xs font-mono font-semibold text-sky-700 bg-sky-50 px-2 py-0.5 rounded">{{ $gejala->kode }}</span>
                            <span class="text-sm font-medium text-gray-800">{{ $gejala->nama }}</span>
                        </label>

                        {{-- Slider — visible only when checked --}}
                        <div x-show="checked" x-transition class="mt-3">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-xs text-gray-500">Tingkat keyakinan</span>
                                <span class="text-xs font-bold text-sky-700" x-text="Math.round(cf * 100) + '%'"></span>
                            </div>
                            <input
                                type="range"
                                name="gejala[{{ $gejala->id }}]"
                                min="0" max="1" step="0.05"
                                x-model="cf"
                                class="w-full h-2 rounded-full appearance-none cursor-pointer accent-sky-600"
                            >
                            <div class="flex justify-between text-xs text-gray-400 mt-1">
                                <span>Tidak yakin</span>
                                <span>Sangat yakin</span>
                            </div>
                        </div>

                        {{-- Hidden input when unchecked to send 0 --}}
                        <input x-show="!checked" type="hidden" name="gejala[{{ $gejala->id }}]" value="0">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Submit --}}
        <div class="mt-6 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Pilih minimal <strong>1 gejala</strong> untuk memulai analisis.
            </p>
            <button
                type="submit"
                :disabled="selectedCount === 0"
                :class="selectedCount > 0 ? 'bg-sky-600 hover:bg-sky-700 cursor-pointer' : 'bg-gray-300 cursor-not-allowed'"
                class="inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-xl transition shadow-md"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Analisis Gejala
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function consultation() {
    return {
        selectedCount: 0,
        onCheck(checked) {
            this.selectedCount += checked ? 1 : -1;
        }
    }
}
</script>
@endpush
