<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');  
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/create-staff', [AdminController::class, 'showCreateStaffForm'])->name('admin.create-staff');
    Route::post('/admin/create-staff', [AdminController::class, 'registerStaff'])->name('admin.register-staff');
});

// Receptionist Routes
Route::middleware(['auth', 'role:receptionist'])->group(function () {
    Route::get('/receptionist/dashboard', [ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');
    Route::post('/receptionist/register-patient', [ReceptionistController::class, 'registerPatient'])->name('receptionist.register-patient');
    Route::post('/receptionist/assign-doctor', [ReceptionistController::class, 'assignDoctor'])->name('receptionist.assign-doctor');
    Route::get('/receptionist/register-patient', [ReceptionistController::class, 'showPatientForm'])->name('receptionist.register-patient');
    Route::get('/receptionist/history/{patientId}', [ReceptionistController::class, 'viewHistory'])->name('receptionist.history');
});

// Nurse Routes
Route::middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/nurse/dashboard', [NurseController::class, 'dashboard'])->name('nurse.dashboard');
    Route::post('/nurse/find-patient', [NurseController::class, 'searchPatient'])->name('nurse.find-patient');
    Route::post('/nurse/vitals/{patientId}', [NurseController::class, 'storeVitals'])->name('nurse.store-vitals');
});

// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/doctor/patient/{patientId}', [DoctorController::class, 'viewPatient'])->name('doctor.view-patient');
    Route::post('/doctor/prescribe/{patientId}', [DoctorController::class, 'prescribe'])->name('doctor.prescribe');
});


// Pharmacist Routes
Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('/pharmacist/dashboard', [PharmacistController::class, 'dashboard'])->name('pharmacist.dashboard');
    Route::post('/pharmacist/verify-patient', [PharmacistController::class, 'verifyPatient'])->name('pharmacist.verify-patient');
    Route::post('/pharmacist/dispense/{prescriptionId}', [PharmacistController::class, 'markAsDispensed'])->name('pharmacist.dispense');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/medications', [PatientController::class, 'medications'])->name('patient.medications');
    Route::get('/patient/appointments', [PatientController::class, 'appointments'])->name('patient.appointments');
});

Route::post('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

require __DIR__.'/auth.php';
