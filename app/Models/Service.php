<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'website_url', 'image', 'is_active', 'is_featured'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function extraDetails()
    {
        return $this->morphMany(ExtraDetail::class, 'detailable')->orderBy('sort_order');
    }
}
