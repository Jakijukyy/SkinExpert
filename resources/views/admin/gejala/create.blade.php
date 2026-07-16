@extends('layouts.app')
@section('title', 'Tambah Gejala')
@section('page-title', 'Tambah Gejala')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-5">
            <ul class="text-sm text-red-700 list-disc list-inside space-y-1">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.gejala.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode <span class="text-red-500">*</span></label>
                <input type="text" name="kode" value="{{ old('kode') }}" placeholder="G36" maxlength="10"
                    class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('kode') border-red-300 @enderror">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Gejala <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Kulit terasa gatal"
                    class="w-full rounded-lg border-gray-300 focus:ring-sky-500 focus:border-sky-500 text-sm @error('nama') border-red-300 @enderror">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.gejala.index') }}" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
