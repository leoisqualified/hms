<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isDoctor() {
        return $this->role === 'doctor';
    }

    public function isNurse() {
        return $this->role === 'nurse';
    }

    public function isPatient() {
        return $this->role === 'patient';
    }

    public function isPharmacist() {
        return $this->role ==='pharmacist';
    }

    public function appointments() {
    return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function vitals() {
        return $this->hasMany(Vitals::class, 'patient_id');
    }

    public function prescription() {
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function doctorPrescriptions() {
        return $this->hasMany(Prescription::class, 'doctor_id');
    }

}
