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

    public function acceptWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === auth()->id() && $workOrder->status === 'pending') {
            $workOrder->update([
                'status' => 'on_the_way',
            ]);

            return redirect()->back()->with('success', 'Work order accepted successfully.');
        }

        return redirect()->back()->with('error', 'Work order not found or not assigned to you.');
    }

    public function startWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === auth()->id() && $workOrder->status === 'on_the_way') {
            $workOrder->update([
                'status' => 'in_progress',
            ]);

            return redirect()->back()->with('success', 'Work order status updated to "In Progress".');
        }

        return redirect()->back()->with('error', 'Work order not found or not in the correct status.');
    }

    public function completeWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === auth()->id()) {
            $workOrder->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Work order completed successfully.');
        }

        return redirect()->back()->with('error', 'Work order not found or not assigned to you.');
    }

    public function viewWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::where('assigned_to_user_id', auth()->id())
            ->with('sourceRequest.location', 'sourceRequest.submittedByUser', 'assignedToUser', 'generatedByUser')
            ->findOrFail($workOrderId);

        return view('technician.view-work-order', compact('workOrder'));
    }
}
