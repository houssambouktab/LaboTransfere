<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class PatientDoctorSeeder extends Seeder
{
    public function run(): void
    {
        // PATIENTS
        $patients = [
            [
                'email' => 'ahmed@gmail.com',
                'date_of_birth' => '1998-05-14',
                'phone' => '0612345678',
                'address' => 'Rabat, Agdal',
            ],
            [
                'email' => 'salma@gmail.com',
                'date_of_birth' => '2001-09-22',
                'phone' => '0623456789',
                'address' => 'Casablanca, Maarif',
            ],
        ];

        foreach ($patients as $data) {
            $user = User::where('email', $data['email'])->firstOrFail();

            DB::table('patients')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'date_of_birth' => $data['date_of_birth'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // DOCTORS
        $doctors = [
            [
                'email' => 'youssef@labo.ma',
                'specialty' => 'Biologie médicale',
                'phone' => '0634567890',
            ],
            [
                'email' => 'nadia@labo.ma',
                'specialty' => 'Hématologie',
                'phone' => '0645678901',
            ],
        ];

        foreach ($doctors as $data) {
            $user = User::where('email', $data['email'])->firstOrFail();

            DB::table('doctors')->updateOrInsert(
                ['user_id' => $user->id],
                [
                    'specialty' => $data['specialty'],
                    'phone' => $data['phone'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
