<x-layout title="Prescriptions">
    <h2>Prescriptions</h2>
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prescriptions as $prescription)
                <tr>
                    <td>{{ $prescription->patient->user->name }}</td>
                    <td>{{ $prescription->doctor->user->name }}</td>
                    <td>{{ $prescription->medication }}</td>
                    <td>{{ $prescription->dosage }}</td>
                    <td>
                        <a href="{{ route('prescriptions.show', $prescription) }}">View</a>
                        <a href="{{ route('prescriptions.edit', $prescription) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
