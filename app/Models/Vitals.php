<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vitals extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nurse_id',
        'blood_pressure',
        'heart_rate',
        'tempearture'
    ];

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function nurse() {
        return $this->belongsTo(User::class, 'nurse');
    }
}
