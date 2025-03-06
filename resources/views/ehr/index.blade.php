<x-layout title="Electronic Health Records">
    <h2>Patient Health Records</h2>
    <table>
        <thead>
            <tr>
                <th>Patient</th>
                <th>Doctor</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ehr as $record)
                <tr>
                    <td>{{ $record->patient->user->name }}</td>
                    <td>{{ $record->doctor->user->name }}</td>
                    <td>{{ $record->diagnosis }}</td>
                    <td>{{ $record->treatment }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('ehr.show', $record) }}">View</a>
                        <a href="{{ route('ehr.edit', $record) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
