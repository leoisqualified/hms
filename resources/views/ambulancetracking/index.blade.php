<x-layout title="Ambulance Tracking">
    <h2>Ambulance Tracking</h2>
    <table>
        <thead>
            <tr>
                <th>Ambulance Number</th>
                <th>Driver</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ambulances as $ambulance)
                <tr>
                    <td>{{ $ambulance->vehicle_number }}</td>
                    <td>{{ $ambulance->driver_name }}</td>
                    <td>{{ $ambulance->current_location }}</td>
                    <td>{{ ucfirst($ambulance->status) }}</td>
                    <td>
                        <a href="{{ route('ambulancetracking.show', $ambulance) }}">View</a>
                        <a href="{{ route('ambulancetracking.edit', $ambulance) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
