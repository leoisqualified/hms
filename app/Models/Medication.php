<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{

    protected $fillable = [
        'medication_name', 
        'dosage', 
        'prescription_id', 
        'price',
        'is_paid'
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
