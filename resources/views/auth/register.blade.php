<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800">Create an Account</h2>
            <p class="text-center text-gray-600 text-sm mb-6">Register to access the system</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" type="text" name="name" :value="old('name')" required 
                        class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required 
                        class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required 
                        class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required 
                        class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 outline-none" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Role Selection -->
                <div class="mt-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select id="role" name="role" required 
                        class="w-full px-4 py-2 mt-1 rounded-lg bg-gray-50 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        <option value="patient">Patient</option>
                        <option value="doctor">Doctor</option>
                        <option value="nurse">Nurse</option>
                        <option value="pharmacist">Pharmacist</option>
                        <option value="admin">Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                </div>
                
                <!-- Register Button -->
                <div class="mt-6">
                    <button type="submit" 
                        class="w-full px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">Already have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login here</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
