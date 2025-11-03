<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TechnicianDashboard extends Component
{
    public function accept($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === Auth::id() && $workOrder->status === 'pending') {
            $workOrder->update([
                'status' => 'accepted',
            ]);

            // Notify the teacher who submitted the original request
            $teacher = $workOrder->sourceRequest->submittedByUser;
            Notification::create([
                'type' => 'work_order_accepted',
                'title' => 'Work Order Accepted',
                'message' => 'Technician ' . Auth::user()->name . ' has accepted the work order for your maintenance request.',
                'user_id' => $teacher->id,
                'sender_id' => Auth::id(),
                'related_id' => $workOrder->id,
            ]);

            session()->flash('message', 'Work order accepted successfully.');
        }
    }

    public function complete($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === Auth::id()) {
            $workOrder->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            session()->flash('message', 'Work order completed successfully.');
        }
    }

    public function markNotificationRead($notificationId)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        $this->render(); // Re-render to update the view
    }

    public function render()
    {
        $workOrders = WorkOrder::where('assigned_to_user_id', Auth::id())
            ->with('sourceRequest.location')
            ->get();

        $notifications = Notification::forUser(Auth::id())->unread()->get();

        return view('livewire.technician-dashboard', compact('workOrders', 'notifications'));
    }
}
