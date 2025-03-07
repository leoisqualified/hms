<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'gender',
        'blood_type',
        'emergency_contact',
        'insurance_id',
        'address'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function ehr() {
        return $this->hasOne(EHR::class);
    }

    public function prescriptions() {
        return $this->hasMany(Prescription::class);
    }
}
