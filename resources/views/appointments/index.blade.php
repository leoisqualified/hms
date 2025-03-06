<x-layout title="Appointments">
    <h2>Appointments</h2>
    <a href="{{ route('appointments.create') }}" class="button">Schedule Appointment</a>
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->user->name }}</td>
                    <td>{{ $appointment->doctor->user->name }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment) }}" class="button">View</a>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="button">Edit</a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Cancel</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
