<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EHR extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'doctor_id', 
        'diagnosis', 
        'allergies', 
        'medications', 
        'medical_history', 
        'lab_results', 
        'radiology_reports'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
