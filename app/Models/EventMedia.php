<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMedia extends Model
{
    protected $fillable = ['event_id', 'type', 'path', 'title', 'order'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
