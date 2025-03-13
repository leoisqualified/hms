<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NurseController extends Controller
{
    public function dashboard()
    {
        $patients = User::where('role', 'patient')->get();

        return view('nurse.dashboard', compact('patients'));
    }
}
