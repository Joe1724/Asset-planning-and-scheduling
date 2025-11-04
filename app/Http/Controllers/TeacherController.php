<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MaintenanceRequest;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $locations = Location::all();
        $notifications = Notification::forUser(Auth::id())->unread()->get();
        return view('teacher.dashboard', compact('locations', 'notifications'));
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'description' => 'required|string|max:1000',
        ]);

        $maintenanceRequest = MaintenanceRequest::create([
            'submitted_by_user_id' => Auth::id(),
            'location_id' => $request->location_id,
            'description' => $request->description,
            'status' => 'pending',
            'title' => 'Maintenance Request',
        ]);

        // Notify all managers
        $managers = User::where('role', 'manager')->get();
        foreach ($managers as $manager) {
            Notification::create([
                'type' => 'maintenance_request',
                'title' => 'New Maintenance Request',
                'message' => 'A new maintenance request has been submitted by ' . Auth::user()->name . ' for location: ' . $maintenanceRequest->location->name,
                'user_id' => $manager->id,
                'sender_id' => Auth::id(),
                'related_id' => $maintenanceRequest->id,
            ]);
        }

        return redirect()->back()->with('success', 'Maintenance request submitted successfully.');
    }

    public function markNotificationRead($notificationId)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($notificationId);
        $notification->update(['is_read' => true]);

        return redirect()->back()->with('message', 'Notification marked as read.');
    }
}