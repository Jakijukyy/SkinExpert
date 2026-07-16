<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
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

        return view('dashboard', compact('recentDiagnoses', 'totalDiagnoses'));
    }
}
