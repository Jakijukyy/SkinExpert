@extends('layouts.app')
@section('title', 'Basis Pengetahuan')
@section('page-title', 'Basis Pengetahuan (Rules)')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total <strong class="text-gray-800">{{ $rules->total() }}</strong> rules</p>
        <a href="{{ route('admin.rules.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Rule
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">#</th>
                        <th class="px-4 py-3 text-left">Penyakit</th>
                        <th class="px-4 py-3 text-left">Gejala</th>
                        <th class="px-4 py-3 text-left">CF Pakar</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rules as $r)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $r->id }}</td>
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-sky-700 bg-sky-50 px-2 py-0.5 rounded mr-1">{{ $r->penyakit->kode }}</span>
                            <span class="font-medium text-gray-900">{{ $r->penyakit->nama }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="font-mono text-xs text-violet-700 bg-violet-50 px-2 py-0.5 rounded mr-1">{{ $r->gejala->kode }}</span>
                            <span class="text-gray-700">{{ $r->gejala->nama }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-20 bg-gray-100 rounded-full h-1.5">
                                    <div class="h-1.5 bg-sky-500 rounded-full" style="width: {{ $r->cf_pakar * 100 }}%"></div>
                                </div>
                                <span class="font-semibold text-gray-700 text-xs">{{ $r->cf_pakar }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <x-table-actions
                                :edit-route="route('admin.rules.edit', $r)"
                                :delete-route="route('admin.rules.destroy', $r)"
                                delete-message="Hapus rule ini?"
                            />
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">Belum ada data rules.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>{{ $rules->links() }}</div>
</div>
@endsection
