<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceClaim extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'billing_id', 
        'insurance_company', 
        'status'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function billing() {
        return $this->belongsTo(Billing::class);
    }
}
