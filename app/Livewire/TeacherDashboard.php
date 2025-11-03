<?php

namespace App\Livewire;

use App\Models\Location;
use App\Models\MaintenanceRequest;
use Livewire\Component;

class TeacherDashboard extends Component
{
    public $location_id;
    public $description;

    public function save()
    {
        $this->validate([
            'location_id' => 'required|exists:locations,id',
            'description' => 'required|string|max:1000',
        ]);

        MaintenanceRequest::create([
            'submitted_by_user_id' => auth()->id(),
            'location_id' => $this->location_id,
            'description' => $this->description,
            'status' => 'pending',
            'title' => 'Maintenance Request',
        ]);

        session()->flash('message', 'Maintenance request submitted successfully.');

        $this->reset(['location_id', 'description']);
    }

    public function render()
    {
        $locations = Location::all();

        return view('livewire.teacher-dashboard', compact('locations'));
    }
}
