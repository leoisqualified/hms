<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrescriptionPaymentController;
use App\Http\Controllers\PharmacistController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});


// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('/patient/book-appointment', [AppointmentController::class, 'create'])->name('patient.book-appointment');
    Route::post('/patient/book-appointment', [AppointmentController::class, 'store'])->name('patient.book-appointment.store');
    Route::get('/payment/appointment/{id}', [PaymentController::class, 'payAppointment'])->name('patient.pay-appointment');
    Route::get('/payment/success/{id}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/prescription/{id}', [PrescriptionPaymentController::class, 'payPrescription'])->name('prescription.pay');
    Route::get('/payment/prescription/success/{id}', [PrescriptionPaymentController::class, 'paymentSuccess'])->name('prescription.payment.success');
    Route::get('/patient/prescriptions', [PrescriptionPaymentController::class, 'index'])->name('patient.prescriptions');
});


// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
    Route::put('/doctor/complete/{id}', [DoctorController::class, 'completeAppointment'])->name('doctor.complete');
    Route::get('/doctor/prescribe/{id}', [DoctorController::class, 'prescribeMedication'])->name('doctor.prescribe');
    Route::post('/doctor/prescribe/{id}', [DoctorController::class, 'storePrescription'])->name('doctor.prescribe.store');
});


// Pharmacist Routes
Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('pharmacist/dashboard', [PharmacistController::class, 'index'])->name('pharmacist.dashboard');
    Route::put('pharmacist/dispense/{id}', [PharmacistController::class, 'dispenseMedication'])->name('pharmacist.dispense');
});

// Nurse Routes
Route::middleware(['auth', 'role:nurse'])->group(function () {
    Route::get('/nurse/dashboard', [NurseController::class, 'index'])->name('nurse.dashboard');
    Route::get('/nurse/record/{id}', [NurseController::class, 'recordVitals'])->name('nurse.record');
    Route::post('/nurse/record/{id}', [NurseController::class, 'storeVitals'])->name('nurse.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');
    Route::put('/admin/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.update-user');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');
    Route::get('/admin/manage-appointments', [AdminController::class, 'manageAppointments'])->name('admin.manage-appointments');
    Route::put('/admin/update-appointment/{id}', [AdminController::class, 'updateAppointment'])->name('admin.update-appointment');
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
