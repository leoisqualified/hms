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
        'role',
        'password'
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

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function vitals()
    {
        return $this->hasMany(Vitals::class, 'patient_id', 'id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'patient_id');
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id');
    }

    public function patientRecord()
    {
        return $this->hasOne(Patient::class, 'user_id');
    }

    public function dispensationsMade()
    {
        return $this->hasMany(Dispensation::class, 'pharmacist_id');
    }

    // Doctor's lab tests
    public function labTestsRequested()
    {
        return $this->hasMany(LabTest::class, 'doctor_id');
    }

    // Patient's lab tests
    public function labTests()
    {
        return $this->hasMany(LabTest::class, 'patient_id');
    }

    // Lab technician's assigned tests
    public function assignedLabTests()
    {
        return $this->hasMany(LabTest::class, 'lab_technician_id');
    }
}
