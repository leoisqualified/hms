<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        if ($user->role == 'patient') {
            return redirect()->route('patient.dashboard');
        } elseif ($user->role == 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            abort(403, 'Unauthorized access');
        }
    }
}
