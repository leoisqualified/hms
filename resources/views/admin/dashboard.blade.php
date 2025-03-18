@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>

    <h3>Quick Links</h3>
    <a href="{{ route('admin.manage-users') }}" class="btn btn-primary">Manage Users</a>
    <a href="{{ route('admin.manage-appointments') }}" class="btn btn-secondary">Manage Appointments</a>

    <h3>System Overview</h3>
    <table class="table">
        <tr>
            <th>Total Users</th>
            <th>Total Appointments</th>
            <th>Total Payments</th>
        </tr>
        <tr>
            <td>{{ count($users) }}</td>
            <td>{{ count($appointments) }}</td>
            <td>${{ $payments->sum('price') }}</td>
        </tr>
    </table>
</div>
@endsection
