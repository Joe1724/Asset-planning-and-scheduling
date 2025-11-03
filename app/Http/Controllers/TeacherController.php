<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $locations = Location::all();
        return view('teacher.dashboard', compact('locations'));
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'location_id' => 'required|exists:locations,id',
            'description' => 'required|string|max:1000',
        ]);

        MaintenanceRequest::create([
            'submitted_by_user_id' => auth()->id(),
            'location_id' => $request->location_id,
            'description' => $request->description,
            'status' => 'pending',
            'title' => 'Maintenance Request',
        ]);

        return redirect()->back()->with('success', 'Maintenance request submitted successfully.');
    }
}
