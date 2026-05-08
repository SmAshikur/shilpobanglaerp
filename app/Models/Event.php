<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'thumbnail', 'event_date', 'is_active', 'is_featured'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'event_date' => 'date',
    ];

    public function media()
    {
        return $this->hasMany(EventMedia::class)->orderBy('order');
    }

    public function extraDetails()
    {
        return $this->morphMany(ExtraDetail::class, 'detailable')->orderBy('sort_order');
    }
}
