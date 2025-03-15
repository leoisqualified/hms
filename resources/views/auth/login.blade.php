<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center text-gray-800">Welcome Back</h2>
            <p class="text-center text-gray-600 text-sm mb-6">Login to continue managing your health</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
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

                <!-- Remember Me -->
                <div class="mt-4 flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="mt-6">
                    <button type="submit" 
                        class="w-full px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                        Login
                    </button>
                </div>

                <!-- Register Link -->
                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">New here? 
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Create an account</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
