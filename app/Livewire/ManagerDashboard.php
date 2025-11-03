<?php

namespace App\Livewire;

use App\Models\MaintenanceRequest;
use App\Models\WorkOrder;
use App\Models\User;
use Livewire\Component;

class ManagerDashboard extends Component
{
    public function convertToWorkOrder($requestId)
    {
        $request = MaintenanceRequest::find($requestId);

        if ($request && $request->status === 'pending') {
            $request->update(['status' => 'approved']);

            // Find a technician user (assuming role 'technician')
            $technician = User::where('role', 'technician')->first();

            if ($technician) {
                WorkOrder::create([
                    'asset_id' => 1, // Default asset
                    'source_request_id' => $request->id,
                    'assigned_to_user_id' => $technician->id,
                    'generated_by_user_id' => auth()->id(),
                    'title' => 'Maintenance Request: ' . substr($request->description, 0, 50) . '...',
                    'description' => $request->description,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]);

                session()->flash('message', 'Request converted to work order successfully.');
            } else {
                session()->flash('error', 'No technician available to assign the work order.');
            }
        }
    }

    public function render()
    {
        $requests = MaintenanceRequest::where('status', 'pending')->with('location', 'submittedByUser')->get();

        return view('livewire.manager-dashboard', compact('requests'));
    }
}
