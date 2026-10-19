<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Lab',
                'email' => 'admin@labo.ma',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ahmed Alaoui',
                'email' => 'ahmed@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salma Bennani',
                'email' => 'salma@gmail.com',
                'password' => Hash::make('123'),
                'role' => 'patient',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Youssef Amrani',
                'email' => 'youssef@labo.ma',
                'password' => Hash::make('123'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dr. Nadia Karim',
                'email' => 'nadia@labo.ma',
                'password' => Hash::make('123'),
                'role' => 'doctor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
