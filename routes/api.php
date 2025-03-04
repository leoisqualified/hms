<?php

use Illuminate\Support\Facades\Route;

// Import the controllers
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EhrController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\AuthController; // Import authentication controller

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (requires authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('patients', PatientController::class);
    Route::apiResource('doctors', DoctorController::class);
    Route::apiResource('appointments', AppointmentController::class);
    Route::apiResource('ehr', EhrController::class);
    Route::apiResource('prescriptions', PrescriptionController::class);
    Route::apiResource('billing', BillingController::class);

    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);
});
