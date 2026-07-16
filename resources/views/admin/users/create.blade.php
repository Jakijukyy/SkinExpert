@extends('layouts.app')
@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf
            @include('admin.users._form')
            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-semibold rounded-lg transition">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg text-center transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
