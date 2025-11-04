<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOrder extends Model
{
    protected $fillable = [
        'asset_id',
        'assigned_to_user_id',
        'generated_by_user_id',
        'source_task_id',
        'source_request_id',
        'status',
        'priority',
        'title',
        'description',
        'planning_description',
        'scheduled_start_at',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'status' => 'string',
        'priority' => 'string',
        'scheduled_start_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function assignedToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function generatedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }

    public function sourceTask(): BelongsTo
    {
        return $this->belongsTo(MaintenanceTask::class, 'source_task_id');
    }

    public function sourceRequest(): BelongsTo
    {
        return $this->belongsTo(MaintenanceRequest::class, 'source_request_id');
    }

    public function workOrderComponents(): HasMany
    {
        return $this->hasMany(WorkOrderComponent::class);
    }
}
