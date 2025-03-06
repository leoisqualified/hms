<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth.login'); // Home is now the login page
});

// Auth routes
require __DIR__.'/auth.php';

// Role-based dashboards
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->middleware('doctor')->name('doctor.dashboard');
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->middleware('patient')->name('patient.dashboard');
});
