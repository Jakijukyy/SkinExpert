@extends('layouts.app')
@section('title', 'Tambah Penyakit')
@section('page-title', 'Tambah Penyakit')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 space-y-5">
        <form action="{{ route('admin.penyakit.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.penyakit._form')
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.penyakit.index') }}" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
