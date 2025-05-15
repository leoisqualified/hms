<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'patient_id', 'lab_technician_id',
        'test_type', 'notes', 'status', 'result',
        'requested_at', 'completed_at'
    ];

    
    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function labTechnician() {
        return $this->belongsTo(User::class, 'lab_technician_id');
    }

    // public function patient() {
    //     return $this->belongsTo(Patient::class);
    // }
}
