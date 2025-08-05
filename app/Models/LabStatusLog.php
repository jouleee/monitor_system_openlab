<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabStatusLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'previous_status_id',
        'new_status_id',
        'changed_by',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    /**
     * Get the lab that owns the log.
     */
    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    /**
     * Get the previous status.
     */
    public function previousStatus()
    {
        return $this->belongsTo(Status::class, 'previous_status_id');
    }

    /**
     * Get the new status.
     */
    public function newStatus()
    {
        return $this->belongsTo(Status::class, 'new_status_id');
    }

    /**
     * Get the user who made the change.
     */
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
