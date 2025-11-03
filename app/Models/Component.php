<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Component extends Model
{
    protected $fillable = [
        'name',
        'part_number',
        'current_stock',
        'min_stock_level',
        'storage_bin',
    ];

    protected $casts = [
        'current_stock' => 'integer',
        'min_stock_level' => 'integer',
    ];

    public function workOrderComponents(): HasMany
    {
        return $this->hasMany(WorkOrderComponent::class);
    }
}
