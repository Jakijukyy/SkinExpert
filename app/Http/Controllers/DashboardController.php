<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentDiagnoses = Diagnosa::with('penyakit')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $totalDiagnoses = Diagnosa::where('user_id', $user->id)->count();

        // Highest CF ever achieved
        $bestDiagnosis = Diagnosa::with('penyakit')
            ->where('user_id', $user->id)
            ->orderByDesc('cf_tertinggi')
            ->first();

        // Average CF across all diagnoses
        $avgCf = round((Diagnosa::where('user_id', $user->id)->avg('cf_tertinggi') ?? 0) * 100, 1);

        // Diagnoses this month vs last month
        $thisMonth = Diagnosa::where('user_id', $user->id)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $lastMonth = Diagnosa::where('user_id', $user->id)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        // Most frequently diagnosed disease
        $topDisease = Diagnosa::with('penyakit')
            ->selectRaw('penyakit_tertinggi_id, COUNT(*) as total')
            ->where('user_id', $user->id)
            ->whereNotNull('penyakit_tertinggi_id')
            ->groupBy('penyakit_tertinggi_id')
            ->orderByDesc('total')
            ->first();

        // Last 7 days chart data
        $chartLabels = [];
        $chartData   = [];
        for ($i = 6; $i >= 0; $i--) {
            $date           = now()->subDays($i);
            $chartLabels[]  = $date->translatedFormat('D');
            $chartData[]    = Diagnosa::where('user_id', $user->id)
                ->whereDate('created_at', $date->toDateString())
                ->count();
        }

        return view('dashboard', compact(
            'user',
            'recentDiagnoses',
            'totalDiagnoses',
            'bestDiagnosis',
            'avgCf',
            'thisMonth',
            'lastMonth',
            'topDisease',
            'chartLabels',
            'chartData'
        ));
    }
}
