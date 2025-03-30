@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">
                            <i class="fas fa-prescription-bottle-alt text-primary me-2"></i>Prescribe Medication
                        </h2>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <hr class="mt-2 mb-0">
                    <div class="d-flex align-items-center mt-2">
                        <div class="avatar-sm bg-light rounded-circle me-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $appointment->patient->name }}</h6>
                            <small class="text-muted">Appointment: {{ \Carbon\Carbon::parse($appointment->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('doctor.prescribe.store', $appointment->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="medicationName" class="form-label fw-bold">
                                <i class="fas fa-pills me-2"></i>Medication Name
                            </label>
                            <input type="text" 
                                   name="medication" 
                                   id="medicationName" 
                                   class="form-control form-control-lg" 
                                   placeholder="e.g. Amoxicillin 500mg" 
                                   required>
                            <div class="invalid-feedback">
                                Please enter the medication name
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Use generic name first, then brand if needed
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="prescriptionInstructions" class="form-label fw-bold">
                                <i class="fas fa-list-alt me-2"></i>Instructions
                            </label>
                            <textarea name="instructions" 
                                      id="prescriptionInstructions" 
                                      class="form-control form-control-lg" 
                                      rows="4"
                                      placeholder="e.g. Take 1 tablet every 8 hours for 7 days with food"
                                      required></textarea>
                            <div class="invalid-feedback">
                                Please provide detailed instructions
                            </div>
                            <small class="text-muted mt-1 d-block">
                                <i class="fas fa-info-circle me-1"></i> Include dosage, frequency, duration, and special instructions
                            </small>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="prescriptionPrice" class="form-label fw-bold">
                                    <i class="fas fa-money-bill-wave me-2"></i>Price ($)
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           name="price" 
                                           id="prescriptionPrice" 
                                           class="form-control form-control-lg" 
                                           step="0.01" 
                                           min="0" 
                                           placeholder="0.00" 
                                           required>
                                </div>
                                <div class="invalid-feedback">
                                    Please enter a valid price
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="refills" class="form-label fw-bold">
                                    <i class="fas fa-redo me-2"></i>Refills
                                </label>
                                <select name="refills" id="refills" class="form-select form-select-lg">
                                    <option value="0">No refills</option>
                                    <option value="1">1 refill</option>
                                    <option value="2">2 refills</option>
                                    <option value="3">3 refills</option>
                                    <option value="unlimited">Unlimited refills</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="additionalNotes" class="form-label fw-bold">
                                <i class="fas fa-sticky-note me-2"></i>Additional Notes (Optional)
                            </label>
                            <textarea name="notes" 
                                      id="additionalNotes" 
                                      class="form-control" 
                                      rows="2"
                                      placeholder="Any special notes for the pharmacist"></textarea>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i> Clear Form
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-file-prescription me-1"></i> Issue Prescription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styling for prescription form */
    .form-control-lg, .form-select-lg {
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
        .form-control-lg, .form-select-lg {
            padding: 0.5rem 0.75rem;
        }
        
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
        
        // Auto-format price input
        const priceInput = document.getElementById('prescriptionPrice');
        if (priceInput) {
            priceInput.addEventListener('blur', function() {
                if (this.value && !isNaN(this.value)) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        }
        
        // Medication name auto-suggest (example)
        const medInput = document.getElementById('medicationName');
        if (medInput) {
            medInput.addEventListener('input', function() {
                // In a real implementation, you might fetch suggestions from an API
                console.log('Fetching suggestions for: ' + this.value);
            });
        }
    });
</script>
@endsection