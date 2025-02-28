<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 
        'ambulance_number', 
        'latitude', 
        'longitude'
    ];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
