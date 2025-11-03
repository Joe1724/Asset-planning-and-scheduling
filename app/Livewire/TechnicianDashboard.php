<?php

namespace App\Livewire;

use App\Models\WorkOrder;
use Livewire\Component;

class TechnicianDashboard extends Component
{
    public function complete($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder && $workOrder->assigned_to_user_id === auth()->id()) {
            $workOrder->update([
                'status' => 'Completed',
                'completed_at' => now(),
            ]);

            session()->flash('message', 'Work order completed successfully.');
        }
    }

    public function render()
    {
        $workOrders = WorkOrder::where('assigned_to_user_id', auth()->id())
            ->with('sourceRequest.location')
            ->get();

        return view('livewire.technician-dashboard', compact('workOrders'));
    }
}
