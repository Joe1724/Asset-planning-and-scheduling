<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function dashboard()
    {
        $workOrders = WorkOrder::where('assigned_to_user_id', auth()->id())
            ->with('sourceRequest.location')
            ->get();

        return view('technician.dashboard', compact('workOrders'));
    }

    public function completeWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === auth()->id()) {
            $workOrder->update([
                'status' => 'Completed',
                'completed_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Work order completed successfully.');
        }

        return redirect()->back()->with('error', 'Work order not found or not assigned to you.');
    }
}
