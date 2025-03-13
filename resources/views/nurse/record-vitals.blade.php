<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Record Patient Vitals') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('nurse.record-vitals') }}" method="POST">
                        @csrf
                        <div>
                            <label for="patient_id" class="block">Select Patient:</label>
                            <select name="patient_id" class="block w-full border-gray-300 rounded">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="blood_pressure" class="block">Blood Pressure:</label>
                            <input type="text" name="blood_pressure" class="block w-full border-gray-300 rounded">
                        </div>

                        <div class="mt-4">
                            <label for="heart_rate" class="block">Heart Rate:</label>
                            <input type="number" name="heart_rate" class="block w-full border-gray-300 rounded">
                        </div>

                        <div class="mt-4">
                            <label for="temperature" class="block">Temperature:</label>
                            <input type="number" step="0.1" name="temperature" class="block w-full border-gray-300 rounded">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Vitals</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
