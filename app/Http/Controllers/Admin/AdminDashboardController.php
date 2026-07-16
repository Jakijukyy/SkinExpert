<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPenyakit  = Penyakit::count();
        $totalGejala    = Gejala::count();
        $totalUser      = User::where('role', 'user')->count();
        $totalDiagnosa  = Diagnosa::count();

        // Last 7 days diagnoses count per day
        $chartData = Diagnosa::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        // Top diseases diagnosed
        $topDiseases = Diagnosa::with('penyakit')
            ->selectRaw('penyakit_tertinggi_id, COUNT(*) as total')
            ->whereNotNull('penyakit_tertinggi_id')
            ->groupBy('penyakit_tertinggi_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $recentDiagnoses = Diagnosa::with(['user', 'penyakit'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPenyakit',
            'totalGejala',
            'totalUser',
            'totalDiagnosa',
            'chartData',
            'topDiseases',
            'recentDiagnoses'
        ));
    }
}
