<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $requests = MaintenanceRequest::where('status', 'pending')
            ->with('location', 'submittedByUser')
            ->get();

        return view('manager.dashboard', compact('requests'));
    }

    public function convertToWorkOrder($requestId)
    {
        $request = MaintenanceRequest::find($requestId);

        if ($request && $request->status === 'pending') {
            $request->update(['status' => 'approved']);

            // Find a technician user
            $technician = User::where('role', 'technician')->first();

            if ($technician) {
                $workOrder = WorkOrder::create([
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

                return redirect()->route('manager.print-work-order', $workOrder->id);
            } else {
                session()->flash('error', 'No technician available to assign the work order.');
            }
        }

        return redirect()->back();
    }

    public function printWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::with('sourceRequest.location', 'sourceRequest.submittedByUser', 'assignedToUser', 'generatedByUser')->findOrFail($workOrderId);

        return view('manager.print-work-order', compact('workOrder'));
    }
}
