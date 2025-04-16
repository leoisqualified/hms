<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'status',
        'date',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }


    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
