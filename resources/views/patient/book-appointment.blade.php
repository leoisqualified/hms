@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">
                            <i class="fas fa-calendar-plus text-primary me-2"></i>Book Appointment
                        </h2>
                        <a href="{{ route('patient.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('patient.book-appointment.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        
                        <div class="mb-4">
                            <label for="doctorSelect" class="form-label fw-bold">
                                <i class="fas fa-user-md me-2"></i>Select Doctor
                            </label>
                            <select name="doctor_id" id="doctorSelect" class="form-select form-select-lg" required>
                                <option value="" selected disabled>-- Select a doctor --</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" data-specialty="{{ $doctor->specialty ?? 'General' }}">
                                        {{ $doctor->name }} - {{ $doctor->specialty ?? 'General Practitioner' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please select a doctor
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Consider doctor's specialty when booking
                            </small>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="appointmentDate" class="form-label fw-bold">
                                    <i class="fas fa-calendar-day me-2"></i>Appointment Date
                                </label>
                                <input type="date" 
                                       name="date" 
                                       id="appointmentDate" 
                                       class="form-control form-control-lg" 
                                       min="{{ date('Y-m-d') }}" 
                                       max="{{ date('Y-m-d', strtotime('+3 months')) }}" 
                                       required>
                                <div class="invalid-feedback">
                                    Please select a valid date
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="appointmentTime" class="form-label fw-bold">
                                    <i class="fas fa-clock me-2"></i>Appointment Time
                                </label>
                                <input type="time" 
                                       name="time" 
                                       id="appointmentTime" 
                                       class="form-control form-control-lg" 
                                       min="08:00" 
                                       max="17:00" 
                                       required>
                                <div class="invalid-feedback">
                                    Please select a valid time (8AM-5PM)
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-calendar-check me-1"></i> Book Appointment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            @if(isset($upcomingAppointments) && $upcomingAppointments->count() > 0)
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-white py-3">
                    <h3 class="h5 mb-0">
                        <i class="fas fa-calendar-alt text-primary me-2"></i>Your Upcoming Appointments
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->doctor->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $appointment->status === 'confirmed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    /* Custom styles for the booking form */
    .form-select-lg, .form-control-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }
    
    .card {
        border-radius: 0.5rem;
    }
    
    .invalid-feedback {
        display: none;
        color: #dc3545;
    }
    
    .was-validated .form-control:invalid,
    .was-validated .form-select:invalid {
        border-color: #dc3545;
    }
    
    .was-validated .form-control:invalid ~ .invalid-feedback,
    .was-validated .form-select:invalid ~ .invalid-feedback {
        display: block;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header {
            padding: 1rem;
        }
        
        .form-select-lg, .form-control-lg {
            padding: 0.5rem 0.75rem;
        }
    }
    
    @media (max-width: 576px) {
        .d-md-flex {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .btn-lg {
            width: 100%;
        }
    }
</style>

<script>
    // Client-side form validation
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch the form we want to validate
        const form = document.querySelector('.needs-validation');
        
        // Prevent submission if invalid
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
        
        // Set minimum time to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('appointmentDate').min = today;
        
        // Doctor specialty tooltips
        const doctorSelect = document.getElementById('doctorSelect');
        if (doctorSelect) {
            doctorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const specialty = selectedOption.getAttribute('data-specialty');
                // You could show this in a tooltip or info box
            });
        }
    });
</script>
@endsection