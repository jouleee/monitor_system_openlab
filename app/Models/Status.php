<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color_code',
    ];

    /**
     * Get the labs that belong to this status.
     */
    public function labs()
    {
        return $this->hasMany(Lab::class);
    }

    /**
     * Get the previous status logs for this status.
     */
    public function previousStatusLogs()
    {
        return $this->hasMany(LabStatusLog::class, 'previous_status_id');
    }

    /**
     * Get the new status logs for this status.
     */
    public function newStatusLogs()
    {
        return $this->hasMany(LabStatusLog::class, 'new_status_id');
    }
}
