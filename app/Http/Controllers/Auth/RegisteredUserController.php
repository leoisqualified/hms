<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    use HasRoles;
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,doctor,nurse,pharmacist,patient'], // Ensure role is valid
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role
        $user->assignRole($request->role);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        return match (true) {
            $user->hasRole('patient') => redirect()->route('patient.dashboard'),
            $user->hasRole('doctor') => redirect()->route('doctor.dashboard'),
            $user->hasRole('nurse') => redirect()->route('nurse.dashboard'),
            $user->hasRole('pharmacist') => redirect()->route('pharmacist.dashboard'),
            $user->hasRole('admin') => redirect()->route('admin.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
}
