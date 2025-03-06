<x-layout title="Doctors">
    <h2>Doctors List</h2>
    <a href="{{ route('doctors.create') }}" class="button">Add Doctor</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Specialization</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->specialization }}</td>
                    <td>
                        <a href="{{ route('doctors.show', $doctor) }}" class="button">View</a>
                        <a href="{{ route('doctors.edit', $doctor) }}" class="button">Edit</a>
                        <form action="{{ route('doctors.destroy', $doctor) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
