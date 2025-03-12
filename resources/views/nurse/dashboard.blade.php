<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nurse Dashboard</h2>
    </x-slot>

    <div class="bg-white p-6 shadow-md rounded-lg">
        <h3 class="text-lg font-bold">Patients to Record Vitals</h3>
        <ul>
            @foreach ($patients as $patient)
                <li class="border-b py-2">
                    <a href="{{ route('nurse.vitals', $patient->id) }}" class="text-blue-500">{{ $patient->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
