<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::withTrashed()->orderBy('kode')->paginate(15);

        return view('admin.gejala.index', compact('gejalas'));
    }

    public function create()
    {
        return view('admin.gejala.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:10', 'unique:gejalas,kode'],
            'nama' => ['required', 'string', 'max:255'],
        ]);

        Gejala::create($data);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil ditambahkan.');
    }

    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'));
    }

    public function update(Request $request, Gejala $gejala)
    {
        $data = $request->validate([
            'kode' => ['required', 'string', 'max:10', 'unique:gejalas,kode,' . $gejala->id],
            'nama' => ['required', 'string', 'max:255'],
        ]);

        $gejala->update($data);

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil dihapus.');
    }

    public function restore(int $id)
    {
        Gejala::withTrashed()->findOrFail($id)->restore();

        return redirect()->route('admin.gejala.index')
            ->with('success', 'Gejala berhasil dipulihkan.');
    }
}
