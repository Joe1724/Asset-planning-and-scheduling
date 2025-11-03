<?php

namespace Database\Seeders;

use App\Models\MaintenanceRequest;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaintenanceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();
        $locations = \App\Models\Location::all();

        if ($teacher && $locations->count() > 0) {
            MaintenanceRequest::create([
                'submitted_by_user_id' => $teacher->id,
                'location_id' => $locations->first()->id,
                'title' => 'Projector Issue in Classroom A',
                'description' => 'The projector in Classroom A is not working properly. The image is flickering and the lamp seems to be failing.',
                'status' => 'pending',
            ]);

            MaintenanceRequest::create([
                'submitted_by_user_id' => $teacher->id,
                'location_id' => $locations->skip(1)->first()->id ?? $locations->first()->id,
                'title' => 'AC Unit Noise in Classroom B',
                'description' => 'The air conditioning unit in Classroom B is making loud noises and not cooling effectively.',
                'status' => 'pending',
            ]);

            MaintenanceRequest::create([
                'submitted_by_user_id' => $teacher->id,
                'location_id' => $locations->skip(2)->first()->id ?? $locations->first()->id,
                'title' => 'Slow Computers in Library',
                'description' => 'Several computers in the library are running very slowly and need maintenance.',
                'status' => 'approved',
            ]);

            MaintenanceRequest::create([
                'submitted_by_user_id' => $teacher->id,
                'location_id' => $locations->skip(3)->first()->id ?? $locations->first()->id,
                'title' => 'Gym Floor Repair',
                'description' => 'The gymnasium floor has several cracks and needs repair before the next sports season.',
                'status' => 'approved',
            ]);

            MaintenanceRequest::create([
                'submitted_by_user_id' => $teacher->id,
                'location_id' => $locations->skip(4)->first()->id ?? $locations->first()->id,
                'title' => 'Leaking Drinking Fountain',
                'description' => 'The drinking fountain in Office 1 is leaking and needs to be fixed.',
                'status' => 'pending',
            ]);
        }
    }
}
