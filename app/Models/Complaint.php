<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'resident_id',
        'photo_path',
        'description',
        'area',
        'status',
        'wing',
        'floor',
    ];

    public function resident()
    {
        return $this->belongsTo(User::class, 'resident_id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
}
