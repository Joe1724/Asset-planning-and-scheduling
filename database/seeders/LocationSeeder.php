<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create(['name' => 'Classroom A', 'type' => 'room']);
        Location::create(['name' => 'Classroom B', 'type' => 'room']);
        Location::create(['name' => 'Library', 'type' => 'area']);
        Location::create(['name' => 'Gym', 'type' => 'area']);
        Location::create(['name' => 'Office 1', 'type' => 'room']);
        Location::create(['name' => 'Office 2', 'type' => 'room']);
    }
}
