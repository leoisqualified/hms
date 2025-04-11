<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('admin.dashboard', compact('totalUsers'));
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
}
