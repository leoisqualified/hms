@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Receptionist Dashboard</h2>

    <a href="{{ route('receptionist.register-patient') }}" class="btn btn-primary mb-3">Register New Patient</a>

    <form action="{{ route('receptionist.assign-doctor') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" name="patient_id" class="form-control" placeholder="Patient ID" required>
            </div>
            <div class="col">
                <select name="doctor_id" class="form-control" required>
                    <option value="">-- Select Doctor --</option>
                    @foreach(\App\Models\User::where('role', 'doctor')->get() as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-success">Assign Doctor</button>
            </div>
        </div>
    </form>

    <h4>Registered Patients</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Patient ID</th>
                <th>History</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>{{ $patient->patient_id }}</td>
                    <td>
                        <a href="{{ route('receptionist.history', $patient->patient_id) }}" class="btn btn-info btn-sm">View History</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $patients->links() }}
</div>
@endsection
