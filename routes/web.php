<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PrescriptionPaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
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
