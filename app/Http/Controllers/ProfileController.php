<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Diagnosa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page with statistics.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Diagnosa statistics for this user
        $totalDiagnoses = Diagnosa::where('user_id', $user->id)->count();

        $recentDiagnoses = Diagnosa::with('penyakit')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Most frequent disease diagnosed
        $mostFrequent = Diagnosa::with('penyakit')
            ->selectRaw('penyakit_tertinggi_id, COUNT(*) as total')
            ->where('user_id', $user->id)
            ->whereNotNull('penyakit_tertinggi_id')
            ->groupBy('penyakit_tertinggi_id')
            ->orderByDesc('total')
            ->first();

        // Average CF from all user diagnoses
        $avgCf = Diagnosa::where('user_id', $user->id)->avg('cf_tertinggi') ?? 0;

        // Diagnoses per month (last 6 months)
        $monthlyData = Diagnosa::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        return view('profile.edit', compact(
            'user',
            'totalDiagnoses',
            'recentDiagnoses',
            'mostFrequent',
            'avgCf',
            'monthlyData'
        ));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('profile.edit')->with('status', 'password-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
