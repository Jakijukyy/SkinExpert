<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DiseaseController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::withTrashed()->latest()->paginate(10);

        return view('admin.penyakit.index', compact('penyakits'));
    }

    public function create()
    {
        return view('admin.penyakit.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'       => ['required', 'string', 'max:10', 'unique:penyakits,kode'],
            'nama'       => ['required', 'string', 'max:255'],
            'deskripsi'  => ['required', 'string'],
            'penyebab'   => ['required', 'string'],
            'solusi'     => ['required', 'string'],
            'pencegahan' => ['required', 'string'],
            'gambar'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('penyakit', 'public');
        }

        Penyakit::create($data);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil ditambahkan.');
    }

    public function edit(Penyakit $penyakit)
    {
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $data = $request->validate([
            'kode'       => ['required', 'string', 'max:10', 'unique:penyakits,kode,' . $penyakit->id],
            'nama'       => ['required', 'string', 'max:255'],
            'deskripsi'  => ['required', 'string'],
            'penyebab'   => ['required', 'string'],
            'solusi'     => ['required', 'string'],
            'pencegahan' => ['required', 'string'],
            'gambar'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($penyakit->gambar) {
                Storage::disk('public')->delete($penyakit->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('penyakit', 'public');
        }

        $penyakit->update($data);

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil dihapus.');
    }

    public function restore(int $id)
    {
        Penyakit::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.penyakit.index')
            ->with('success', 'Penyakit berhasil dipulihkan.');
    }
}
