<?php

namespace Database\Seeders;

use App\Models\MaintenanceRequest;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technician = User::where('role', 'technician')->first();
        $manager = User::where('role', 'manager')->first();
        $approvedRequests = MaintenanceRequest::where('status', 'approved')->get();

        if ($technician && $manager && $approvedRequests->count() > 0) {
            foreach ($approvedRequests as $request) {
                WorkOrder::create([
                    'asset_id' => 1, // Default asset ID since we don't have assets seeded
                    'source_request_id' => $request->id,
                    'assigned_to_user_id' => $technician->id,
                    'generated_by_user_id' => $manager->id,
                    'title' => 'Maintenance Request: ' . substr($request->description, 0, 50) . '...',
                    'description' => $request->description,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]);
            }

            // Create one completed work order
            $firstWorkOrder = WorkOrder::first();
            if ($firstWorkOrder) {
                $firstWorkOrder->update([
                    'status' => 'Completed',
                    'completed_at' => now(),
                ]);
            }
        }
    }
}
