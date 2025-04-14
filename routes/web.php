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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::get('/admin/patients', [AdminController::class, 'listPatients'])->name('admin.patients');
    Route::get('/admin/patients/{patient}/edit', [AdminController::class, 'editPatient'])->name('admin.patients.edit');
    Route::put('/admin/patients/{patient}', [AdminController::class, 'updatePatient'])->name('admin.patients.update');
    Route::delete('/admin/patients/{patient}', [AdminController::class, 'deletePatient'])->name('admin.patients.destroy');
    Route::get('/admin/schedules', [AdminController::class, 'doctorSchedules'])->name('admin.schedules');
    Route::get('/admin/schedule/{id}', [AdminController::class, 'manageDoctorSchedule'])->name('admin.schedule.manage');
    Route::post('/admin/schedule/{doctorId}', [AdminController::class, 'storeDoctorSchedule'])->name('admin.schedule.store');
    Route::delete('/admin/schedule/{id}', [AdminController::class, 'deleteDoctorSchedule'])->name('admin.schedule.delete');
    Route::get('/admin/schedule/{id}/edit', [AdminController::class, 'editDoctorSchedule'])->name('admin.schedule.edit');
    Route::put('/admin/schedule/{id}', [AdminController::class, 'updateDoctorSchedule'])->name('admin.schedule.update');
    Route::get('/admin/activity-logs', [AdminController::class, 'activityLogs'])->name('admin.logs');


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
    Route::get('/nurse/find-patient', [NurseController::class, 'searchPatient'])->name('nurse.find-patient');
    Route::post('/nurse/vitals/{patientId}', [NurseController::class, 'storeVitals'])->name('nurse.store-vitals');
});

// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/doctor/patient/{patientId}', [DoctorController::class, 'viewPatient'])->name('doctor.view-patient');
    Route::post('/doctor/prescribe/{patientId}', [DoctorController::class, 'prescribe'])->name('doctor.prescribe');
    Route::get('/doctor/schedules', [DoctorController::class, 'mySchedules'])->name('doctor.schedules');
});


// Pharmacist Routes
Route::middleware(['auth', 'role:pharmacist'])->group(function () {
    Route::get('/pharmacist/dashboard', [PharmacistController::class, 'dashboard'])->name('pharmacist.dashboard');
    Route::get('/pharmacist/verify-patient', [PharmacistController::class, 'verifyPatient'])->name('pharmacist.verify-patient');
    Route::get('/pharmacist/verify-patient', [PharmacistController::class, 'verifyPatient'])->name('pharmacist.verify-patient');
    Route::post('/pharmacist/dispense/{prescriptionId}', [PharmacistController::class, 'markAsDispensed'])->name('pharmacist.dispense');
});

// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/medications', [PatientController::class, 'medications'])->name('patient.medications');
    Route::get('/patient/appointments', [PatientController::class, 'appointments'])->name('patient.appointments');
    Route::delete('/patient/appointments/{appointment}/cancel', [PatientController::class, 'cancelAppointment'])->name('patient.cancel-appointment');
});

Route::post('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

require __DIR__.'/auth.php';
