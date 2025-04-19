<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\User;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a patient user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'role' => 'patient',
            'password' => bcrypt('password'), // make sure it's hashed
        ]);

        // Create the linked patient record
        Patient::create([
            'user_id' => $user->id,
            'patient_id' => 'PAT-1001', // or generate dynamically if needed
        ]);
    }
}
