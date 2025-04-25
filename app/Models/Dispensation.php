<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dispensation extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'pharmacist_id', 'dispensed_at'];

    public function pharmacist()
    {
        return $this->belongsTo(User::class, 'pharmacist_id');
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
