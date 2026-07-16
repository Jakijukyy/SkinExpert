@php $p = $penyakit ?? null; @endphp

@if($errors->any())
<div class="bg-red-50 border border-red-200 rounded-lg p-4">
    <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
    </ul>
</div>
@endif

<div class="grid sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kode <span class="text-red-500">*</span></label>
        <input type="text" name="kode" value="{{ old('kode', $p?->kode) }}" placeholder="P01"
            class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('kode') border-red-300 @enderror">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penyakit <span class="text-red-500">*</span></label>
        <input type="text" name="nama" value="{{ old('nama', $p?->nama) }}" placeholder="Dermatitis Atopik"
            class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('nama') border-red-300 @enderror">
    </div>
</div>

@foreach([['deskripsi', 'Deskripsi'], ['penyebab', 'Penyebab'], ['solusi', 'Solusi / Penanganan'], ['pencegahan', 'Pencegahan']] as [$field, $label])
<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }} <span class="text-red-500">*</span></label>
    <textarea name="{{ $field }}" rows="3"
        class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error($field) border-red-300 @enderror">{{ old($field, $p?->$field) }}</textarea>
</div>
@endforeach

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar <span class="text-gray-400 text-xs">(Opsional, maks 2MB)</span></label>
    @if($p?->gambar)
        <div class="mb-2">
            <img src="{{ Storage::url($p->gambar) }}" alt="{{ $p->nama }}" class="h-20 rounded-lg object-cover border border-gray-200">
        </div>
    @endif
    <input type="file" name="gambar" accept="image/*"
        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
</div>
