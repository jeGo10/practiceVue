<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('chirps', ChirpController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('tasks', TaskController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('divisions', DivisionController::class);
});

Route::middleware('auth')->group(function () {
    Route::resource('UserManagement', UserManagementController::class);
});


require __DIR__.'/auth.php';
