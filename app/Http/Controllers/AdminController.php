<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\User;
use App\Mail\SendCredentialsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $recentActivities = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'activeAppointments', 'recentActivities'));
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

    // Doctor schedules
    public function doctorSchedules()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.doctor-schedules', compact('doctors'));
    }

    // Manage Doctor Schedule
    public function manageDoctorSchedule($id)
    {
        $doctor = User::findOrFail($id);
        $schedules = DoctorSchedule::where('doctor_id', $id)->get();

        return view('admin.manage-doctor-schedule', compact('doctor', 'schedules'));
    }

    public function storeDoctorSchedule(Request $request, $doctorId)
    {
        $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        DoctorSchedule::create([
            'doctor_id' => $doctorId,
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->back()->with('success', 'Schedule slot added successfully.');
    }

    public function deleteDoctorSchedule($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->delete();

        return redirect()->back()->with('success', 'Schedule slot deleted.');
    }

    public function editDoctorSchedule($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        return view('admin.edit-schedule', compact('schedule'));
    }

    public function updateDoctorSchedule(Request $request, $id)
    {
        $request->validate([
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->update([
            'day_of_week' => $request->day_of_week,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('admin.schedule.manage')->with('success', 'Schedule updated successfully.');
    }

    public function activityLogs(Request $request)
{
    abort_unless(Auth::user()->is_admin, 403);

    $search = $request->input('search');

    $logs = ActivityLog::with('user')
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })
            ->orWhere('description', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(20);

    return view('admin.activity-logs', compact('logs', 'search'));
}

}
