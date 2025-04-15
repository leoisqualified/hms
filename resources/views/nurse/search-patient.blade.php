@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <!-- Modern card with glass morphism effect -->
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-white/20">
            <!-- Gradient header with subtle animation -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-white/0"></div>
                <div class="flex items-center justify-between relative z-10">
                    <h2 class="text-2xl font-bold text-white tracking-tight">Patient Lookup</h2>
                    <a href="{{ url()->previous() }}" class="p-1 rounded-full hover:bg-white/10 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <!-- Notifications with modern animation -->
                @if ($errors->has('not_found'))
                <div class="mb-6 animate-fade-in-down" role="alert">
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">{{ $errors->first('not_found') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if (session('success'))
                <div class="mb-6 animate-fade-in-down" role="alert">
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Modern form with floating labels -->
                <form action="{{ route('nurse.find-patient') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="relative z-0">
                        <input type="text" name="patient_id" id="patient_id" 
                               class="block w-full px-4 py-3 text-gray-900 bg-transparent border border-gray-300 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent peer"
                               placeholder=" " required />
                        <label for="patient_id" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-3 left-3 z-10 origin-[0] bg-white px-1 peer-focus:px-1 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-3 peer-focus:scale-75 peer-focus:-translate-y-4">Patient ID</label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg shadow-md hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search Patient
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 0.5s ease-out;
    }
    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection