<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = \App\Models\Location::all();

        if ($locations->count() > 0) {
            Asset::create([
                'name' => 'Projector A1',
                'location_id' => $locations->first()->id,
                'category' => 'electrical',
                'manufacturer' => 'Epson',
                'model_number' => 'EB-S41',
                'serial_number' => 'PROJ-001',
                'status' => 'active',
            ]);

            Asset::create([
                'name' => 'Air Conditioning Unit B1',
                'location_id' => $locations->skip(1)->first()->id ?? $locations->first()->id,
                'category' => 'hvac',
                'manufacturer' => 'Daikin',
                'model_number' => 'FTXS35K',
                'serial_number' => 'AC-001',
                'status' => 'active',
            ]);

            Asset::create([
                'name' => 'Library Computer 1',
                'location_id' => $locations->skip(2)->first()->id ?? $locations->first()->id,
                'category' => 'electrical',
                'manufacturer' => 'Dell',
                'model_number' => 'OptiPlex 7090',
                'serial_number' => 'COMP-001',
                'status' => 'active',
            ]);

            Asset::create([
                'name' => 'Gym Floor Covering',
                'location_id' => $locations->skip(3)->first()->id ?? $locations->first()->id,
                'category' => 'structural',
                'manufacturer' => 'Sport Court',
                'model_number' => 'Pro',
                'serial_number' => 'FLOOR-001',
                'status' => 'active',
            ]);

            Asset::create([
                'name' => 'Drinking Fountain O1',
                'location_id' => $locations->skip(4)->first()->id ?? $locations->first()->id,
                'category' => 'plumbing',
                'manufacturer' => 'Halsey Taylor',
                'model_number' => 'HydroBoost',
                'serial_number' => 'FOUNTAIN-001',
                'status' => 'active',
            ]);
        }
    }
}
