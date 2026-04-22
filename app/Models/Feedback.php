<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'complaint_id',
        'rating',
        'comment',
    ];

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
