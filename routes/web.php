<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Inertia\Inertia;

// Redirect root URL to the login page
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

// Dashboard route
Route::get('/dashboard', function () {
    // Eager load the 'roles' relationship using a query builder
    $user = User::with('roles')->find(Auth::id());

    return Inertia::render('Dashboard', [
        'auth' => [
            'user' => $user
        ]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require authentication
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes
    Route::resource('chirps', ChirpController::class);
    Route::resource('tasks', TaskController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('forms', FormController::class);
    Route::resource('archives', ArchiveController::class);

    // This route should only be access Admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('UserManagement', UserManagementController::class);
     });
});


// Auth routes (register, login, etc.)
require __DIR__.'/auth.php';
