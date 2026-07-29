@extends('layouts.app')

@section('title', 'Konsultasi')
@section('page-title', 'Mulai Konsultasi')

@push('styles')
<style>
    /* Custom range slider styling */
    .cf-slider {
        -webkit-appearance: none;
        appearance: none;
        width: 100%;
        height: 6px;
        border-radius: 9999px;
        outline: none;
        cursor: pointer;
        background: linear-gradient(to right, #0ea5e9 0%, #0ea5e9 var(--val, 80%), #e2e8f0 var(--val, 80%), #e2e8f0 100%);
    }
    .cf-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #0ea5e9;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #0ea5e9, 0 2px 6px rgba(14,165,233,0.4);
        cursor: pointer;
        transition: box-shadow 0.15s;
    }
    .cf-slider::-webkit-slider-thumb:hover {
        box-shadow: 0 0 0 3px rgba(14,165,233,0.3), 0 2px 6px rgba(14,165,233,0.5);
    }
    .cf-slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #0ea5e9;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #0ea5e9;
        cursor: pointer;
    }
    .cf-slider::-moz-range-track {
        height: 6px;
        border-radius: 9999px;
        background: #e2e8f0;
    }
    .gejala-card.selected {
        border-color: #0ea5e9;
        background-color: #f0f9ff;
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto space-y-5">

    {{-- Info banner --}}
    <div class="bg-gradient-to-r from-sky-50 to-blue-50 border border-sky-200 rounded-xl p-5 flex gap-3">
        <div class="w-9 h-9 bg-sky-500 rounded-full flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="text-sm text-sky-900">
            <p class="font-semibold mb-1">Cara Pengisian</p>
            <p class="text-sky-700 leading-relaxed">Klik kartu gejala yang Anda rasakan, kemudian geser slider untuk menentukan <strong>seberapa yakin</strong> Anda merasakan gejala tersebut. Pilih minimal 1 gejala.</p>
        </div>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex gap-3">
            <svg class="w-5 h-5 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                <p class="text-sm font-semibold text-red-800 mb-1">Terjadi kesalahan:</p>
                <ul class="text-sm text-red-700 list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('consultation.store') }}" method="POST" id="consultationForm">
        @csrf

        {{-- Header row --}}
        <div class="flex items-center justify-between mb-3">
            <div>
                <p class="text-sm font-semibold text-gray-800">Daftar Gejala</p>
                <p class="text-xs text-gray-400">{{ $gejalas->count() }} gejala tersedia</p>
            </div>
            <div class="flex items-center gap-2 bg-sky-50 border border-sky-200 rounded-lg px-3 py-1.5">
                <div class="w-2 h-2 rounded-full bg-sky-500" id="selectedDot"></div>
                <span class="text-sm font-semibold text-sky-700" id="selectedCounter">0 dipilih</span>
            </div>
        </div>

        {{-- Gejala cards --}}
        <div class="space-y-3" id="gejalaList">
            @foreach($gejalas as $gejala)
            <div class="gejala-card bg-white rounded-xl border-2 border-gray-100 shadow-sm transition-all duration-200 overflow-hidden"
                 id="card-{{ $gejala->id }}">

                {{-- Card header (clickable) --}}
                <div class="flex items-center gap-4 p-4 cursor-pointer select-none"
                     onclick="toggleGejala({{ $gejala->id }})">

                    {{-- Custom checkbox visual --}}
                    <div class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center shrink-0 transition-all duration-200"
                         id="check-{{ $gejala->id }}">
                        <svg class="w-3.5 h-3.5 text-white hidden" id="checkmark-{{ $gejala->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>

                    {{-- Label --}}
                    <div class="flex-1 flex items-center gap-2.5">
                        <span class="inline-block text-xs font-mono font-bold text-sky-700 bg-sky-50 border border-sky-100 px-2 py-0.5 rounded shrink-0">
                            {{ $gejala->kode }}
                        </span>
                        <span class="text-sm font-medium text-gray-800 leading-tight">{{ $gejala->nama }}</span>
                    </div>

                    {{-- CF badge (visible when selected) --}}
                    <div class="shrink-0 hidden" id="badge-{{ $gejala->id }}">
                        <span class="inline-flex items-center gap-1 bg-sky-500 text-white text-xs font-bold px-2.5 py-1 rounded-full" id="badge-text-{{ $gejala->id }}">
                            80%
                        </span>
                    </div>
                </div>

                {{-- Slider panel (hidden by default) --}}
                <div class="hidden" id="slider-panel-{{ $gejala->id }}">
                    <div class="px-4 pb-4 pt-0 border-t border-sky-100 bg-sky-50/50">
                        <div class="flex items-center justify-between mb-2 mt-3">
                            <span class="text-xs font-medium text-gray-500">Seberapa yakin Anda merasakan gejala ini?</span>
                            <span class="text-sm font-bold text-sky-600" id="cf-label-{{ $gejala->id }}">80%</span>
                        </div>

                        {{-- Visual confidence scale --}}
                        <div class="mb-3">
                            <input
                                type="range"
                                class="cf-slider"
                                id="slider-{{ $gejala->id }}"
                                min="5" max="100" step="5"
                                value="80"
                                style="--val: 80%"
                                oninput="updateSlider({{ $gejala->id }}, this.value)"
                            >
                            <div class="flex justify-between text-xs text-gray-400 mt-1.5">
                                <span>Tidak yakin (5%)</span>
                                <span>Ragu-ragu (50%)</span>
                                <span>Sangat yakin (100%)</span>
                            </div>
                        </div>

                        {{-- Level indicator --}}
                        <div class="flex gap-1.5 items-center">
                            <span class="text-xs text-gray-500">Keyakinan:</span>
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full" id="level-{{ $gejala->id }}">Yakin</span>
                        </div>
                    </div>
                </div>

                {{-- Hidden input for form submission — always present, value set by JS --}}
                <input type="hidden" name="gejala[{{ $gejala->id }}]" id="input-{{ $gejala->id }}" value="">
            </div>
            @endforeach
        </div>

        {{-- Submit bar --}}
        <div class="sticky bottom-4 mt-6">
            <div class="bg-white border border-gray-200 rounded-2xl shadow-lg px-5 py-4 flex items-center justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-gray-900" id="submitLabel">Pilih minimal 1 gejala</p>
                    <p class="text-xs text-gray-400" id="submitSub">Klik kartu gejala di atas untuk memulai</p>
                </div>
                <button
                    type="submit"
                    id="submitBtn"
                    disabled
                    class="inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-xl transition-all duration-200 shadow bg-gray-300 cursor-not-allowed"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Analisis Sekarang
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Track which gejala are selected: { id: cfValue (0.05–1.0) }
const selected = {};

function toggleGejala(id) {
    if (selected[id] !== undefined) {
        // Deselect
        delete selected[id];
        document.getElementById('input-' + id).value = '';
        document.getElementById('card-' + id).classList.remove('selected');
        document.getElementById('check-' + id).classList.remove('bg-sky-500', 'border-sky-500');
        document.getElementById('check-' + id).classList.add('border-gray-300');
        document.getElementById('checkmark-' + id).classList.add('hidden');
        document.getElementById('slider-panel-' + id).classList.add('hidden');
        document.getElementById('badge-' + id).classList.add('hidden');
    } else {
        // Select — default CF = 0.8 (80%)
        const defaultCf = 0.8;
        selected[id] = defaultCf;
        document.getElementById('input-' + id).value = defaultCf;
        document.getElementById('card-' + id).classList.add('selected');
        document.getElementById('check-' + id).classList.add('bg-sky-500', 'border-sky-500');
        document.getElementById('check-' + id).classList.remove('border-gray-300');
        document.getElementById('checkmark-' + id).classList.remove('hidden');
        document.getElementById('slider-panel-' + id).classList.remove('hidden');
        document.getElementById('badge-' + id).classList.remove('hidden');
    }
    refreshUI();
}

function updateSlider(id, val) {
    const cfVal = parseFloat(val) / 100;
    selected[id] = cfVal;
    document.getElementById('input-' + id).value = cfVal;

    // Update label
    document.getElementById('cf-label-' + id).textContent = val + '%';
    document.getElementById('badge-text-' + id).textContent = val + '%';

    // Update track gradient
    document.getElementById('slider-' + id).style.setProperty('--val', val + '%');

    // Update level badge
    const level = document.getElementById('level-' + id);
    if (val >= 80) {
        level.textContent = 'Sangat Yakin';
        level.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-green-100 text-green-700';
    } else if (val >= 55) {
        level.textContent = 'Yakin';
        level.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-sky-100 text-sky-700';
    } else if (val >= 30) {
        level.textContent = 'Ragu-ragu';
        level.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700';
    } else {
        level.textContent = 'Tidak Yakin';
        level.className = 'text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-700';
    }
}

function refreshUI() {
    const count = Object.keys(selected).length;

    // Counter
    document.getElementById('selectedCounter').textContent = count + ' dipilih';
    document.getElementById('selectedDot').style.background = count > 0 ? '#0ea5e9' : '#94a3b8';

    // Submit button
    const btn = document.getElementById('submitBtn');
    const label = document.getElementById('submitLabel');
    const sub = document.getElementById('submitSub');

    if (count > 0) {
        btn.disabled = false;
        btn.className = 'inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-xl transition-all duration-200 shadow bg-sky-600 hover:bg-sky-700 cursor-pointer';
        label.textContent = count + ' gejala dipilih';
        sub.textContent = 'Siap untuk dianalisis dengan Certainty Factor';
    } else {
        btn.disabled = true;
        btn.className = 'inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-xl transition-all duration-200 shadow bg-gray-300 cursor-not-allowed';
        label.textContent = 'Pilih minimal 1 gejala';
        sub.textContent = 'Klik kartu gejala di atas untuk memulai';
    }
}

// Safety: before submit, clear any hidden inputs that are not selected
document.getElementById('consultationForm').addEventListener('submit', function(e) {
    // Make sure only selected gejala have values, unselected have no name attribute
    document.querySelectorAll('[id^="input-"]').forEach(function(input) {
        if (!input.value) {
            input.removeAttribute('name');
        }
    });
});
</script>
@endpush
