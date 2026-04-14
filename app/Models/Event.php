<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'event_date', 'is_active'];

    public function media()
    {
        return $this->hasMany(EventMedia::class)->orderBy('order');
    }
}
