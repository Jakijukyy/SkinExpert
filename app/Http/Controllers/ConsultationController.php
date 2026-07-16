<?php

namespace App\Http\Controllers;

use App\Models\DetailDiagnosa;
use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function __construct(private CertaintyFactorService $cfService) {}

    /**
     * Show the consultation symptom selection form.
     */
    public function create()
    {
        $gejalas = Gejala::orderBy('kode')->get();

        return view('consultation.create', compact('gejalas'));
    }

    /**
     * Process the submitted symptoms and run CF calculation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gejala'   => ['required', 'array', 'min:1'],
            'gejala.*' => ['numeric', 'min:0', 'max:1'],
        ], [
            'gejala.required' => 'Pilih minimal satu gejala untuk memulai konsultasi.',
            'gejala.min'      => 'Pilih minimal satu gejala untuk memulai konsultasi.',
        ]);

        // Filter only checked (non-zero) symptoms
        $selectedSymptoms = array_filter(
            $request->input('gejala', []),
            fn ($cf) => $cf > 0
        );

        if (empty($selectedSymptoms)) {
            return back()->withErrors(['gejala' => 'Pilih minimal satu gejala dengan tingkat keyakinan lebih dari 0.']);
        }

        // Cast keys to int
        $selectedSymptoms = array_combine(
            array_map('intval', array_keys($selectedSymptoms)),
            array_map('floatval', array_values($selectedSymptoms))
        );

        $results = $this->cfService->calculate($selectedSymptoms);

        if (empty($results)) {
            return back()->withErrors(['gejala' => 'Tidak ditemukan penyakit yang cocok dengan gejala yang dipilih. Coba pilih gejala yang berbeda.']);
        }

        $highest   = $results[0];
        $penyakit  = Penyakit::find($highest['penyakit_id']);

        DB::transaction(function () use ($selectedSymptoms, $results, $highest, &$diagnosa) {
            $diagnosa = Diagnosa::create([
                'user_id'               => Auth::id(),
                'tanggal'               => now(),
                'penyakit_tertinggi_id' => $highest['penyakit_id'],
                'cf_tertinggi'          => $highest['cf'],
                'hasil_json'            => $results,
            ]);

            foreach ($selectedSymptoms as $gejalaId => $cfUser) {
                DetailDiagnosa::create([
                    'diagnosa_id' => $diagnosa->id,
                    'gejala_id'   => $gejalaId,
                    'cf_user'     => $cfUser,
                ]);
            }
        });

        return redirect()->route('consultation.result', $diagnosa->id);
    }

    /**
     * Display the diagnosis result.
     */
    public function result(Diagnosa $diagnosa)
    {
        // Only the owner or admin can view a diagnosis
        if ($diagnosa->user_id !== Auth::id() && ! Auth::user()->isAdmin()) {
            abort(403);
        }

        $diagnosa->load(['penyakit', 'details.gejala', 'user']);

        return view('consultation.result', compact('diagnosa'));
    }

    /**
     * Show diagnosis history for the logged-in user.
     */
    public function history()
    {
        $diagnoses = Diagnosa::with('penyakit')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('consultation.history', compact('diagnoses'));
    }
}
