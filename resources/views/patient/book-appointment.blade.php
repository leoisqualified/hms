<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white p-6 shadow-md rounded-lg">
            @if(session('success'))
                <div class="bg-green-200 p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('patient.book-appointment') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="doctor" class="block text-sm font-medium text-gray-700">Select Doctor</label>
                    <select name="doctor_id" id="doctor" required class="w-full mt-1 p-2 border rounded-lg">
                        <option value="">-- Select a Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                    <input type="date" name="date" id="date" required class="w-full mt-1 p-2 border rounded-lg">
                </div>

                <div class="mb-4">
                    <label for="time" class="block text-sm font-medium text-gray-700">Select Time</label>
                    <input type="time" name="time" id="time" required class="w-full mt-1 p-2 border rounded-lg">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    Book Appointment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
