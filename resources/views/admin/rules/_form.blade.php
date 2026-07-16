@if($errors->any())
<div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5">
    <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
</div>
@endif

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Penyakit <span class="text-red-500">*</span></label>
    <select name="penyakit_id" class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('penyakit_id') border-red-300 @enderror">
        <option value="">-- Pilih Penyakit --</option>
        @foreach($penyakits as $p)
            <option value="{{ $p->id }}" {{ old('penyakit_id', $rule->penyakit_id ?? '') == $p->id ? 'selected' : '' }}>
                [{{ $p->kode }}] {{ $p->nama }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Gejala <span class="text-red-500">*</span></label>
    <select name="gejala_id" class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('gejala_id') border-red-300 @enderror">
        <option value="">-- Pilih Gejala --</option>
        @foreach($gejalas as $g)
            <option value="{{ $g->id }}" {{ old('gejala_id', $rule->gejala_id ?? '') == $g->id ? 'selected' : '' }}>
                [{{ $g->kode }}] {{ $g->nama }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        CF Pakar <span class="text-red-500">*</span>
        <span class="text-xs text-gray-400 font-normal">(0.01 – 1.00)</span>
    </label>
    <input type="number" name="cf_pakar" value="{{ old('cf_pakar', $rule->cf_pakar ?? 0.8) }}"
        min="0.01" max="1" step="0.01"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('cf_pakar') border-red-300 @enderror">
    <p class="mt-1 text-xs text-gray-400">Nilai keyakinan pakar bahwa gejala ini mengindikasikan penyakit tersebut.</p>
</div>
