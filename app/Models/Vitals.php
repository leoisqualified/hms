<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vitals extends Model
{

    protected $fillable = [
        'patient_id',
        'nurse_id',
        'temperature',
        'blood_pressure',
        'pulse',
        'weight',
    ];
    
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function nurse()
    {
        return $this->belongsTo(User::class, 'nurse_id');
    }
}
