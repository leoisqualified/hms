<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }
        elseif (Auth::user()->hasRole('doctor')) {
            return redirect()->route('doctor.dashboard');
        }
        elseif (Auth::user()->hasRole('nurse')) {
            return redirect()->route('nurse.dashboard');
        }
        elseif (Auth::user()->hasRole('pharmacist')) {
            return redirect()->route('pharmacist.dashboard');
        }
        else {
            return redirect()->route('patient.dashboard');
        }
    }
}
