<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $rules = Rule::with(['penyakit', 'gejala'])
            ->join('penyakits', 'rules.penyakit_id', '=', 'penyakits.id')
            ->join('gejalas', 'rules.gejala_id', '=', 'gejalas.id')
            ->orderBy('penyakits.kode')
            ->orderBy('gejalas.kode')
            ->select('rules.*')
            ->paginate(20);

        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        $penyakits = Penyakit::orderBy('kode')->get();
        $gejalas   = Gejala::orderBy('kode')->get();

        return view('admin.rules.create', compact('penyakits', 'gejalas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'penyakit_id' => ['required', 'exists:penyakits,id'],
            'gejala_id'   => ['required', 'exists:gejalas,id'],
            'cf_pakar'    => ['required', 'numeric', 'min:0.01', 'max:1'],
        ]);

        // Prevent duplicate rule for same penyakit+gejala combination
        $exists = Rule::where('penyakit_id', $data['penyakit_id'])
            ->where('gejala_id', $data['gejala_id'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['gejala_id' => 'Rule untuk kombinasi penyakit dan gejala ini sudah ada.'])->withInput();
        }

        Rule::create($data);

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule berhasil ditambahkan.');
    }

    public function edit(Rule $rule)
    {
        $penyakits = Penyakit::orderBy('kode')->get();
        $gejalas   = Gejala::orderBy('kode')->get();

        return view('admin.rules.edit', compact('rule', 'penyakits', 'gejalas'));
    }

    public function update(Request $request, Rule $rule)
    {
        $data = $request->validate([
            'penyakit_id' => ['required', 'exists:penyakits,id'],
            'gejala_id'   => ['required', 'exists:gejalas,id'],
            'cf_pakar'    => ['required', 'numeric', 'min:0.01', 'max:1'],
        ]);

        // Prevent duplicate — exclude current rule
        $exists = Rule::where('penyakit_id', $data['penyakit_id'])
            ->where('gejala_id', $data['gejala_id'])
            ->where('id', '!=', $rule->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['gejala_id' => 'Rule untuk kombinasi penyakit dan gejala ini sudah ada.'])->withInput();
        }

        $rule->update($data);

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule berhasil diperbarui.');
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();

        return redirect()->route('admin.rules.index')
            ->with('success', 'Rule berhasil dihapus.');
    }
}
