<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 teachers
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Teacher ' . $i,
                'email' => 'teacher' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]);
        }

        // Create 10 managers
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Manager ' . $i,
                'email' => 'manager' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]);
        }

        // Create 10 admins
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Admin ' . $i,
                'email' => 'admin' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]);
        }

        // Create 10 technicians
        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'name' => 'Technician ' . $i,
                'email' => 'technician' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'technician',
            ]);
        }
    }
}
