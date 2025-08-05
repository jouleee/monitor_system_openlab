<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Public dashboard - hanya menampilkan status lab
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes - perlu login
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/labs', [AdminController::class, 'index'])->name('labs.index');
    Route::get('/labs/create', [AdminController::class, 'create'])->name('labs.create');
    Route::post('/labs', [AdminController::class, 'store'])->name('labs.store');
    Route::get('/labs/{lab}/edit', [AdminController::class, 'edit'])->name('labs.edit');
    Route::put('/labs/{lab}', [AdminController::class, 'update'])->name('labs.update');
    Route::delete('/labs/{lab}', [AdminController::class, 'destroy'])->name('labs.destroy');
    Route::patch('/labs/{lab}/status', [AdminController::class, 'updateStatus'])->name('labs.update-status');
});

// API endpoint untuk refresh status (AJAX)
Route::get('/api/lab-status', [DashboardController::class, 'getLabStatus'])->name('api.lab-status');
