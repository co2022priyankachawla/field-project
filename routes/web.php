<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\AssignmentController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Resident Routes
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::post('/feedback', [ComplaintController::class, 'feedback'])->name('feedback.submit');

    // Secretary Routes
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::post('/notifications/send', [AssignmentController::class, 'notifyResident'])->name('notifications.send');

    // Staff Routes
    Route::post('/assignments/{assignment}/complete', [AssignmentController::class, 'complete'])->name('assignments.complete');
});
