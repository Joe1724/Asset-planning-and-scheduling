<?php

namespace App\Http\Controllers;

use App\Models\MaintenanceRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $requests = MaintenanceRequest::where('status', 'pending')
            ->with('location', 'submittedByUser')
            ->get();

        $technicians = User::where('role', 'technician')->get();

        $notifications = Notification::forUser(Auth::id())->unread()->get();

        return view('manager.dashboard', compact('requests', 'technicians', 'notifications'));
    }

    public function convertToWorkOrder(Request $request, $requestId)
    {
        $maintenanceRequest = MaintenanceRequest::find($requestId);

        if ($maintenanceRequest && $maintenanceRequest->status === 'pending') {
            $maintenanceRequest->update(['status' => 'approved']);

            $technicianId = $request->input('technician_id');
            $technician = User::where('role', 'technician')->find($technicianId);

            if ($technician) {
                $workOrder = WorkOrder::create([
                    'asset_id' => 1, // Default asset
                    'source_request_id' => $maintenanceRequest->id,
                    'assigned_to_user_id' => $technician->id,
                    'generated_by_user_id' => Auth::id(),
                    'title' => 'Maintenance Request: ' . substr($maintenanceRequest->description, 0, 50) . '...',
                    'description' => $maintenanceRequest->description,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]);

                // Notify the assigned technician
                Notification::create([
                    'type' => 'work_order',
                    'title' => 'New Work Order Assigned',
                    'message' => 'You have been assigned a new work order: ' . $workOrder->title . ' by ' . Auth::user()->name,
                    'user_id' => $technician->id,
                    'sender_id' => Auth::id(),
                    'related_id' => $workOrder->id,
                ]);

                session()->flash('message', 'Request converted to work order successfully.');

                return redirect()->route('manager.print-work-order', $workOrder->id);
            } else {
                session()->flash('error', 'Selected technician not found.');
            }
        }

        return redirect()->back();
    }

    public function printWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::with('sourceRequest.location', 'sourceRequest.submittedByUser', 'assignedToUser', 'generatedByUser')->findOrFail($workOrderId);

        return view('manager.print-work-order', compact('workOrder'));
    }

    public function markNotificationRead($notificationId)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        return redirect()->back()->with('message', 'Notification marked as read.');
    }
}
