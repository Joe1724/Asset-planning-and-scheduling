<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'default_frequency_days',
        'estimated_time_hours',
    ];

    protected $casts = [
        'category' => 'string',
        'default_frequency_days' => 'integer',
        'estimated_time_hours' => 'decimal:2',
    ];

    public function workOrders(): HasMany
    {
        return $this->hasMany(WorkOrder::class, 'source_task_id');
    }
}
