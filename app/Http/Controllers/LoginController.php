<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle authentication and redirect users based on role.
     */
    public function authenticated(Request $request, $user)
    {
        if ($user->isAdmin()) {
            return redirect('/admin/dashboard');
        } elseif ($user->isDoctor()) {
            return redirect('/doctor/dashboard');
        } else {
            return redirect('/patient/dashboard');
        }
    }
}
