<x-guest-layout>
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 sm:p-8 space-y-6 transition-all duration-300">
            <!-- Logo with better responsive sizing -->
            <div class="flex justify-center">
                <img 
                    src="{{ asset('hospital_logo.jpg') }}" 
                    alt="Hospital Management System Logo" 
                    class="h-[1000px] sm:h-14 w-auto"
                    loading="lazy"
                >
            </div>

            <!-- Title with better hierarchy -->
            <div class="text-center space-y-1">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Hospital Management System</h1>
                <p class="text-sm sm:text-base text-gray-600">Secure Login Portal</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email Field with better spacing -->
                <div class="space-y-2">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                        autocomplete="username"
                        placeholder="Enter your email"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password Field with toggle visibility option -->
                <div class="space-y-2 relative">
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="relative">
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full pr-10" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            placeholder="Enter your password"
                        />
                        <button 
                            type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                            onclick="togglePasswordVisibility()"
                            aria-label="Toggle password visibility"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <label for="remember_me" class="inline-flex items-center">
                        <input 
                            id="remember_me" 
                            type="checkbox" 
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" 
                            name="remember"
                        >
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a 
                            class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline transition-colors" 
                            href="{{ route('password.request') }}"
                        >
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button with loading state -->
                <div>
                    <x-primary-button class="w-full justify-center py-3 px-4" id="login-button">
                        <span id="button-text">{{ __('Log in') }}</span>
                        <svg id="loading-spinner" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </x-primary-button>
                </div>
            </form>

            <!-- Additional hospital-specific links -->
            <div class="text-center text-sm text-gray-500">
                <p>Need help? <a href="#" class="text-indigo-600 hover:underline">Contact IT Support</a></p>
            </div>
        </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Optional: Add loading state to button
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.getElementById('login-button');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('loading-spinner');
            
            button.disabled = true;
            buttonText.textContent = 'Logging in...';
            spinner.classList.remove('hidden');
        });
    </script>
</x-guest-layout>