<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staff = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Receptionist Jane',
                'email' => 'receptionist@example.com',
                'role' => 'receptionist',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dr. Smith',
                'email' => 'doctor@example.com',
                'role' => 'doctor',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Nurse Lisa',
                'email' => 'nurse@example.com',
                'role' => 'nurse',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pharmacist John',
                'email' => 'pharmacist@example.com',
                'role' => 'pharmacist',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Labtechnician Gary',
                'email' => 'labtechnician@example.com',
                'role' => 'labtechnician',
                'password' => Hash::make('password'),
            ]
        ];

        foreach ($staff as $person) {
            User::updateOrCreate(
                ['email' => $person['email']],
                array_merge($person, [
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                ])
            );
        }
    
    }
}
