<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

//Public Routes
Route::get('/', function () {
    return view('auth.login');
})->name('login');


//Admin Route
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Patient Route
Route::middleware(['auth', 'role:patient'])->group(function() {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/book-appointment', [AppointmentController::class, 'create'])->name('patient.book-appointment');
    Route::post('/patient/book-appointment', [AppointmentController::class, 'store']);
});

// Doctor Route
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/doctor/appointments', [AppointmentController::class, 'doctorAppointments'])->name('doctor.appointments');
    Route::post('/doctor/prescribe', [DoctorController::class, 'prescribe'])->name('doctor.prescribe');
});

// Nurse Routes
Route::middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/nurse/dashboard', [NurseController::class, 'dashboard'])->name('nurse.dashboard');
    Route::get('/nurse/vitals', [NurseController::class, 'recordVitals'])->name('nurse.record-vitals');
    Route::post('/nurse/vitals', [NurseController::class, 'storeVitals']);
});

// Pharmacist Routes
Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('/pharmacist/dashboard', [PharmacistController::class, 'dashboard'])->name('pharmacist.dashboard');
    Route::get('/pharmacist/prescriptions', [PharmacistController::class, 'prescriptions'])->name('pharmacist.prescriptions');
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/payment/checkout/{appointment}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success/{appointment}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel/{appointment}', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
