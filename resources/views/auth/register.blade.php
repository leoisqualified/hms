@extends('layouts.auth')

@section('content')
<div class="text-center">
    <h2 class="text-2xl font-semibold text-gray-700">Create an Account</h2>
    <p class="text-sm text-gray-500 mb-6">Register to access your dashboard</p>
</div>

@if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
        <ul class="list-disc pl-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required 
               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
    </div>

    <!-- Email -->
    <div class="mt-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required 
               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" type="password" name="password" required 
               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required 
               class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
    </div>

    <!-- Role Selection -->
    <div class="mt-4">
        <label for="role" class="block text-sm font-medium text-gray-700">Register as</label>
        <select id="role" name="role" required 
                class="w-full p-2 border rounded-md focus:ring focus:ring-blue-300">
            <option value="patient" selected>Patient</option>
            <option value="doctor">Doctor</option>
            <option value="nurse">Nurse</option>
            <option value="pharmacist">Pharmacist</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <!-- Register Button -->
    <div class="mt-6">
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">
            Register
        </button>
    </div>
</form>

<!-- Already have an account? -->
<p class="text-sm text-center text-gray-600 mt-4">
    Already have an account? 
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
</p>
@endsection
