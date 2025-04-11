<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use App\Mail\SendCredentialsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Show dashboard with total number of users
    public function dashboard()
    {
        $totalUsers = User::count();
        $activeAppointments = Appointment::where('status', 'scheduled')->count();

        return view('admin.dashboard', compact('totalUsers', 'activeAppointments'));
    }

    // Show the register staff form
    public function showCreateStaffForm()
    {
        return view('admin.register-staff');
    }

    // Register new staff
    public function registerStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:receptionist,doctor,nurse,pharmacist',
        ]);

        // Generate random password for the staff
        $password = Str::random(8);

        // Create staff member
        $staff = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($password),
        ]);

        // Send the generated credentials to the staff email
        Mail::to($staff->email)->send(new SendCredentialsMail($staff->email, $password));

        return redirect()->back()->with('success', 'Staff registered successfully.');
    }

    public function listPatients()
    {
        $patients = User::where('role', 'patient')->get();
        return view('admin.patient-list', compact('patients'));
    }

    // Show list of patients (with optional search)
    public function patientsList(Request $request)
    {
        $query = User::where('role', 'patient');

        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $patients = $query->latest()->get();

        return view('admin.patient-list', compact('patients'));
    }

    // Show edit form
    public function editPatient(User $patient)
    {
        return view('admin.edit-patient', compact('patient'));
    }

    // Update patient info
    public function updatePatient(Request $request, User $patient)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $patient->id,
        ]);

        $patient->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.patients')->with('success', 'Patient updated successfully.');
    }

    // Delete patient
public function deletePatient(User $patient)
{
    $patient->delete();

    return redirect()->route('admin.patients')->with('success', 'Patient deleted successfully.');
}
}
