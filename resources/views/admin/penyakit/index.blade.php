@extends('layouts.app')
@section('title', 'Data Penyakit')
@section('page-title', 'Data Penyakit')

@section('content')
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Total <strong class="text-gray-800">{{ $penyakits->total() }}</strong> penyakit</p>
        <a href="{{ route('admin.penyakit.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white text-sm font-semibold rounded-lg transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Penyakit
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Rules</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($penyakits as $p)
                    <tr class="hover:bg-gray-50 transition {{ $p->trashed() ? 'opacity-50' : '' }}">
                        <td class="px-4 py-3"><span class="font-mono text-xs font-semibold text-sky-700 bg-sky-50 px-2 py-1 rounded">{{ $p->kode }}</span></td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $p->nama }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $p->rules->count() }} rules</td>
                        <td class="px-4 py-3">
                            @if($p->trashed())
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded-full">Terhapus</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($p->trashed())
                                <x-table-actions :restore-route="route('admin.penyakit.restore', $p->id)" />
                            @else
                                <x-table-actions
                                    :edit-route="route('admin.penyakit.edit', $p)"
                                    :delete-route="route('admin.penyakit.destroy', $p)"
                                    delete-message="Hapus penyakit {{ $p->nama }}? Data terkait juga akan terpengaruh."
                                />
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-gray-400">Belum ada data penyakit.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div>{{ $penyakits->links() }}</div>
</div>
@endsection
