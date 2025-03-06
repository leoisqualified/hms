<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->role === 'doctor') {
            return redirect()->route('doctor.dashboard');
        } elseif (auth()->user()->role === 'patient') {
            return redirect()->route('patient.dashboard');
        }
    }
}
