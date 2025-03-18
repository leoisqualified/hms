<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Prescription;

class AdminController extends Controller
{
    public function dashboard () {
        $users = User::all();
        $appointments = Appointment::all();
        $payments = Prescription::where('paid', true);

        return view('admin.dashboard', compact('users', 'appointments', 'payments'));
    }

    public function manageUsers () {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string|in:patient,doctor,nurse,pharmacist,admin',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.manage-users')->with('success', 'User deleted successfully.');
    }

    public function manageAppointments()
    {
        $appointments = Appointment::all();
        return view('admin.manage-appointments', compact('appointments'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('admin.manage-appointments')->with('success', 'Appointment updated successfully.');
    }
}
