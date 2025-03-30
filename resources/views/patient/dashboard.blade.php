@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">
                    <i class="fas fa-user-injured me-2"></i>Patient Dashboard
                </h2>
                <div class="d-flex gap-2">
                    <a href="{{ route('patient.book-appointment') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-plus me-1"></i> Book Appointment
                    </a>
                    <a href="{{ route('patient.prescriptions') }}" class="btn btn-info">
                        <i class="fas fa-file-prescription me-1"></i> Prescriptions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Your Appointments
                    </h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Doctor</th>
                                    <th>Status</th>
                                    <th class="text-end">Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                    <td>
                                        <span class="d-flex align-items-center">
                                            <i class="fas fa-user-md me-2 text-primary"></i>
                                            {{ $appointment->doctor->name }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'badge bg-warning text-dark',
                                                'confirmed' => 'badge bg-success',
                                                'cancelled' => 'badge bg-danger',
                                                'completed' => 'badge bg-info'
                                            ][$appointment->status] ?? 'badge bg-secondary';
                                        @endphp
                                        <span class="{{ $statusClass }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        @if(!$appointment->is_paid)
                                            <a href="{{ route('patient.pay-appointment', $appointment->id) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-money-bill-wave me-1"></i> Pay Now
                                            </a>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-check-circle me-1"></i> Paid
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($appointments->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No appointments found</h5>
                            <a href="{{ route('patient.book-appointment') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-calendar-plus me-1"></i> Book Your First Appointment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for the dashboard */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 0.75em;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .d-flex.gap-2 {
            width: 100%;
            justify-content: space-between;
        }
        
        .btn {
            width: 48%;
        }
    }
    
    @media (max-width: 576px) {
        .table th, .table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75rem;
        }
    }
</style>
@endsection