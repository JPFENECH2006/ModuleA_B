<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'venue',
        'event_date',
        'category',
        'capacity',
        'status',
        'description',
        'image',
    ];
}
