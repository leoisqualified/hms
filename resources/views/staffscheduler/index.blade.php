<x-layout title="Staff Scheduler">
    <h2>Staff Schedule</h2>
    <table>
        <thead>
            <tr>
                <th>Staff Name</th>
                <th>Role</th>
                <th>Shift</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffSchedules as $schedule)
                <tr>
                    <td>{{ $schedule->staff->user->name }}</td>
                    <td>{{ $schedule->role }}</td>
                    <td>{{ $schedule->shift }}</td>
                    <td>{{ $schedule->date }}</td>
                    <td>
                        <a href="{{ route('staffscheduler.show', $schedule) }}">View</a>
                        <a href="{{ route('staffscheduler.edit', $schedule) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
