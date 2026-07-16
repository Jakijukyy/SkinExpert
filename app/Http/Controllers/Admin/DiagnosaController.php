<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
    public function index()
    {
        $diagnoses = Diagnosa::with(['user', 'penyakit'])
            ->latest()
            ->paginate(15);

        return view('admin.diagnosa.index', compact('diagnoses'));
    }

    public function show(Diagnosa $diagnosa)
    {
        $diagnosa->load(['penyakit', 'details.gejala', 'user']);

        return view('admin.diagnosa.show', compact('diagnosa'));
    }

    public function exportPdf(Diagnosa $diagnosa)
    {
        $diagnosa->load(['penyakit', 'details.gejala', 'user']);

        $pdf = Pdf::loadView('admin.diagnosa.pdf', compact('diagnosa'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('diagnosa-' . $diagnosa->id . '.pdf');
    }

    public function exportAllPdf()
    {
        $diagnoses = Diagnosa::with(['user', 'penyakit'])->latest()->get();

        $pdf = Pdf::loadView('admin.diagnosa.pdf-all', compact('diagnoses'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('semua-diagnosa-' . now()->format('Ymd') . '.pdf');
    }

    public function destroy(Diagnosa $diagnosa)
    {
        $diagnosa->details()->delete();
        $diagnosa->delete();

        return redirect()->route('admin.diagnosa.index')
            ->with('success', 'Data diagnosa berhasil dihapus.');
    }
}
