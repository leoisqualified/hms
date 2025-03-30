@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">
                            <i class="fas fa-user-md text-primary me-2"></i>Doctor Dashboard
                        </h2>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item" href="?filter=upcoming">Upcoming</a></li>
                                <li><a class="dropdown-item" href="?filter=past">Past</a></li>
                                <li><a class="dropdown-item" href="?filter=all">All Appointments</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Patient</th>
                                    <th>Date & Time</th>
                                    <th>Vitals</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light rounded-circle me-3 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $appointment->patient->name }}</h6>
                                                <small class="text-muted">ID: {{ $appointment->patient->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}</div>
                                        <div class="text-muted">{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        @if($appointment->vitals)
                                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#vitalsModal{{ $appointment->id }}">
                                            <i class="fas fa-chart-line me-1"></i> View Vitals
                                        </button>
                                        
                                        <!-- Vitals Modal -->
                                        <div class="modal fade" id="vitalsModal{{ $appointment->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Patient Vitals</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Temperature</label>
                                                                <div class="form-control bg-light">{{ $appointment->vitals->temperature }}°F</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Blood Pressure</label>
                                                                <div class="form-control bg-light">{{ $appointment->vitals->blood_pressure }}</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Pulse</label>
                                                                <div class="form-control bg-light">{{ $appointment->vitals->pulse }} bpm</div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Weight</label>
                                                                <div class="form-control bg-light">{{ $appointment->vitals->weight }} kg</div>
                                                            </div>
                                                            @if($appointment->vitals->notes)
                                                            <div class="col-12">
                                                                <label class="form-label">Notes</label>
                                                                <div class="form-control bg-light" style="min-height: 100px">{{ $appointment->vitals->notes }}</div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-exclamation-circle me-1"></i> Not recorded
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'pending' => 'bg-secondary',
                                                'confirmed' => 'bg-primary',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger'
                                            ][$appointment->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $statusClass }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('doctor.prescribe', $appointment->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="Prescribe Medication">
                                                <i class="fas fa-prescription-bottle-alt"></i>
                                            </a>
                                            <form action="{{ route('doctor.complete', $appointment->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-success" data-bs-toggle="tooltip" title="Mark as Completed">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('doctor.notes', $appointment->id) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" title="Add Clinical Notes">
                                                <i class="fas fa-notes-medical"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">No appointments found</h5>
                                        <p class="text-muted">You don't have any scheduled appointments.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($appointments->count() > 0)
                <div class="card-footer bg-white border-top-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            Showing {{ $appointments->count() }} appointments
                        </div>
                        <div>
                            {{ $appointments->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styling for doctor dashboard */
    .avatar-sm {
        width: 36px;
        height: 36px;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .table-responsive {
            border: 0;
        }
        
        .table thead {
            display: none;
        }
        
        .table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        
        .table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table td:before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
        }
        
        .table td:last-child {
            border-bottom: 0;
        }
        
        .table td[data-label="Patient"] {
            background-color: #f8f9fa;
            font-size: 1.1rem;
        }
        
        .d-flex.gap-2 {
            gap: 0.5rem !important;
        }
    }
    
    @media (max-width: 576px) {
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

<script>
    // Add data-label attributes for mobile view and enable tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Add data labels for responsive table
        const headers = ['Patient', 'Date & Time', 'Vitals', 'Status', 'Actions'];
        const cells = document.querySelectorAll('tbody td');
        
        cells.forEach((td, index) => {
            td.setAttribute('data-label', headers[index % headers.length]);
        });
        
        // Enable tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection