<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DiagnosaController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', fn () => view('landing'))->name('landing');

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Consultation
    Route::prefix('consultation')->name('consultation.')->group(function () {
        Route::get('/start', [ConsultationController::class, 'create'])->name('create');
        Route::post('/store', [ConsultationController::class, 'store'])->name('store');
        Route::get('/result/{diagnosa}', [ConsultationController::class, 'result'])->name('result');
        Route::get('/history', [ConsultationController::class, 'history'])->name('history');
    });
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Penyakit
    Route::resource('penyakit', DiseaseController::class);
    Route::post('penyakit/{id}/restore', [DiseaseController::class, 'restore'])->name('penyakit.restore');

    // Gejala
    Route::resource('gejala', SymptomController::class);
    Route::post('gejala/{id}/restore', [SymptomController::class, 'restore'])->name('gejala.restore');

    // Rules / Basis Pengetahuan
    Route::resource('rules', RuleController::class);

    // Diagnosa
    Route::get('diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa.index');
    Route::get('diagnosa/{diagnosa}', [DiagnosaController::class, 'show'])->name('diagnosa.show');
    Route::get('diagnosa/{diagnosa}/pdf', [DiagnosaController::class, 'exportPdf'])->name('diagnosa.pdf');
    Route::get('diagnosa/export/all', [DiagnosaController::class, 'exportAllPdf'])->name('diagnosa.pdf-all');
    Route::delete('diagnosa/{diagnosa}', [DiagnosaController::class, 'destroy'])->name('diagnosa.destroy');

    // Users
    Route::resource('users', UserController::class);
    Route::post('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
});

require __DIR__ . '/auth.php';
