<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $fillable = [
        'name',
        'location_id',
        'category',
        'status',
        'manufacturer',
        'model_number',
        'serial_number',
        'installation_date',
        'last_inspection_date',
        'next_inspection_due',
    ];

    protected $casts = [
        'category' => 'string',
        'status' => 'string',
        'installation_date' => 'date',
        'last_inspection_date' => 'date',
        'next_inspection_due' => 'date',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function maintenanceRequests(): HasMany
    {
        return $this->hasMany(MaintenanceRequest::class);
    }
}
