@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">
                            <i class="fas fa-prescription-bottle-alt text-primary me-2"></i>Your Prescriptions
                        </h2>
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($appointments->flatMap->prescriptions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">Medication</th>
                                        <th>Instructions</th>
                                        <th>Date Prescribed</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end pe-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        @foreach ($appointment->prescriptions as $prescription)
                                        <tr>
                                            <td class="ps-4 fw-bold">
                                                <i class="fas fa-pills me-2 text-secondary"></i>
                                                {{ $prescription->medication }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-sm btn-outline-info me-2" 
                                                            data-bs-toggle="collapse" 
                                                            data-bs-target="#instructions-{{ $prescription->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <div class="text-truncate" style="max-width: 200px;">
                                                        {{ $prescription->instructions }}
                                                    </div>
                                                </div>
                                                <div class="collapse mt-2" id="instructions-{{ $prescription->id }}">
                                                    <div class="card card-body bg-light">
                                                        {{ $prescription->instructions }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $appointment->date->format('M d, Y') }}
                                            </td>
                                            <td class="text-end">
                                                ${{ number_format($prescription->price, 2) }}
                                            </td>
                                            <td class="text-end pe-4">
                                                @if(!$prescription->paid)
                                                    <a href="{{ route('prescription.pay', $prescription->id) }}" 
                                                       class="btn btn-sm btn-warning">
                                                        <i class="fas fa-money-bill-wave me-1"></i> Pay Now
                                                    </a>
                                                @else
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check-circle me-1"></i> Paid
                                                    </span>
                                                    <small class="text-muted d-block">
                                                        {{ $prescription->paid_at->format('M d, Y') }}
                                                    </small>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-prescription-bottle fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted">No Prescriptions Found</h4>
                            <p class="text-muted">You don't have any prescriptions yet.</p>
                        </div>
                    @endif
                </div>
                @if($appointments->flatMap->prescriptions->count() > 0)
                    <div class="card-footer bg-white border-top-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $appointments->flatMap->prescriptions->count() }} prescriptions
                            </div>
                            <div class="fw-bold">
                                Total Outstanding: ${{ number_format($appointments->flatMap->prescriptions->where('paid', false)->sum('price'), 2) }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styling for prescriptions table */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
    
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }
    
    .card-body .card {
        border: 1px solid rgba(0,0,0,0.1);
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
        
        .table td[data-label="Medication"] {
            background-color: #f8f9fa;
            font-size: 1.1rem;
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
    // Add data-label attributes for mobile view
    document.addEventListener('DOMContentLoaded', function() {
        const headers = ['Medication', 'Instructions', 'Date Prescribed', 'Price', 'Status'];
        const cells = document.querySelectorAll('tbody td');
        
        cells.forEach((td, index) => {
            td.setAttribute('data-label', headers[index % headers.length]);
        });
    });
</script>
@endsection