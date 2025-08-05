<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'status_id',
    ];

    /**
     * Get the status that owns the lab.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the status logs for this lab.
     */
    public function statusLogs()
    {
        return $this->hasMany(LabStatusLog::class);
    }

    /**
     * Get the latest status log for this lab.
     */
    public function latestStatusLog()
    {
        return $this->hasOne(LabStatusLog::class)->latest('changed_at');
    }
}
