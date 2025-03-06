<x-layout title="Patients">
    <h1 class="text-2xl font-bold mb-4">Patients</h1>
    <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Patient</a>

    <table class="w-full mt-4 border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr class="border">
                    <td class="px-4 py-2">{{ $patient->user->name }}</td>
                    <td class="px-4 py-2">{{ $patient->user->email }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('patients.show', $patient) }}" class="text-blue-500">View</a>
                        <a href="{{ route('patients.edit', $patient) }}" class="text-green-500 ml-2">Edit</a>
                        <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
