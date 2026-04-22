<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'complaint_id',
        'staff_id',
        'assigned_by',
        'status',
        'completed_at',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function secretary()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
