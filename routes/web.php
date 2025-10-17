<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PartyController;

// 🏠 Landing route — redirect based on login status
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('voting.index');
    }
    return redirect()->route('login');
});

// 🧭 Unified Dashboard Route (Fixes Route [dashboard] not defined)
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    return $user->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('voting.index');
})->middleware(['auth'])->name('dashboard');

// 🗳 Student Voting Page
Route::middleware(['auth'])->group(function () {
    Route::get('/voting', function () {
        return view('voting.index');
    })->name('voting.index');
});

// 👨‍💼 Admin Dashboard + Admin Modules
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Position Management CRUD
    Route::resource('/admin/positions', PositionController::class);

    // Candidate Management CRUD
    Route::resource('/admin/candidates', CandidateController::class);

    Route::resource('parties', PartyController::class);
});

// 👤 Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Authentication routes (login, register, logout, etc.)
require __DIR__.'/auth.php';
