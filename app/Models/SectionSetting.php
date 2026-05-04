<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSetting extends Model
{
    protected $fillable = ['key', 'title', 'description', 'is_visible'];

    protected $casts = [
        'is_visible' => 'boolean',
    ];
}
