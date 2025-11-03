<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Location;
use App\Models\MaintenanceRequest;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_locations' => Location::count(),
            'total_assets' => Asset::count(),
            'total_requests' => MaintenanceRequest::count(),
            'pending_requests' => MaintenanceRequest::where('status', 'pending')->count(),
            'approved_requests' => MaintenanceRequest::where('status', 'approved')->count(),
            'total_work_orders' => WorkOrder::count(),
            'pending_work_orders' => WorkOrder::where('status', 'pending')->count(),
            'completed_work_orders' => WorkOrder::where('status', 'completed')->count(),
        ];

        $recentRequests = MaintenanceRequest::with('submittedByUser', 'location')
            ->latest()
            ->take(5)
            ->get();

        $recentWorkOrders = WorkOrder::with('assignedToUser', 'sourceRequest.location')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'recentWorkOrders'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function locations()
    {
        $locations = Location::all();
        return view('admin.locations', compact('locations'));
    }

    public function assets()
    {
        $assets = Asset::with('location')->get();
        return view('admin.assets', compact('assets'));
    }

    public function requests()
    {
        $requests = MaintenanceRequest::with('submittedByUser', 'location', 'asset')
            ->latest()
            ->get();
        return view('admin.requests', compact('requests'));
    }

    public function workOrders()
    {
        $workOrders = WorkOrder::with('assignedToUser', 'generatedByUser', 'sourceRequest.location', 'asset')
            ->latest()
            ->get();
        return view('admin.work-orders', compact('workOrders'));
    }

    public function convertToWorkOrder(Request $request, $requestId)
    {
        $maintenanceRequest = MaintenanceRequest::find($requestId);

        if ($maintenanceRequest && $maintenanceRequest->status === 'pending') {
            $maintenanceRequest->update(['status' => 'approved']);

            $technician = User::where('role', 'technician')->first();

            if ($technician) {
                WorkOrder::create([
                    'asset_id' => 1, // Default asset
                    'source_request_id' => $maintenanceRequest->id,
                    'assigned_to_user_id' => $technician->id,
                    'generated_by_user_id' => auth()->id(),
                    'title' => 'Maintenance Request: ' . substr($maintenanceRequest->description, 0, 50) . '...',
                    'description' => $maintenanceRequest->description,
                    'status' => 'pending',
                    'priority' => 'medium',
                ]);

                return redirect()->back()->with('success', 'Request converted to work order successfully.');
            }
        }

        return redirect()->back()->with('error', 'Failed to convert request.');
    }

    public function completeWorkOrder($workOrderId)
    {
        $workOrder = WorkOrder::find($workOrderId);

        if ($workOrder) {
            $workOrder->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            return redirect()->back()->with('success', 'Work order completed successfully.');
        }

        return redirect()->back()->with('error', 'Work order not found.');
    }
}
