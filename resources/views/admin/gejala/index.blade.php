@extends('layouts.app')
@section('title', 'Data Gejala')
@section('page-title', 'Data Gejala')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total <strong class="text-gray-800">{{ $gejalas->total() }}</strong> gejala</p>
        <a href="{{ route('admin.gejala.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Gejala
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama Gejala</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($gejalas as $g)
                    <tr class="hover:bg-gray-50 transition {{ $g->trashed() ? 'opacity-50' : '' }}">
                        <td class="px-4 py-3"><span class="font-mono text-xs font-semibold text-violet-700 bg-violet-50 px-2 py-1 rounded">{{ $g->kode }}</span></td>
                        <td class="px-4 py-3 text-gray-900">{{ $g->nama }}</td>
                        <td class="px-4 py-3">
                            @if($g->trashed())
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full">Terhapus</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($g->trashed())
                                <x-table-actions :restore-route="route('admin.gejala.restore', $g->id)" />
                            @else
                                <x-table-actions
                                    :edit-route="route('admin.gejala.edit', $g)"
                                    :delete-route="route('admin.gejala.destroy', $g)"
                                    delete-message="Hapus gejala ini? Rules yang menggunakan gejala ini juga akan terhapus."
                                />
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400">Belum ada data gejala.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>{{ $gejalas->links() }}</div>
</div>
@endsection
