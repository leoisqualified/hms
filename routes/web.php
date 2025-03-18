<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
});


// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
