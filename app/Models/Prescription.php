<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{

    protected $fillable = [
        'doctor_id',
        'notes',
    ];
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function medications()
    {
        return $this->hasMany(Medication::class);
    }
}
