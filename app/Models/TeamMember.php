<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'position', 'image', 'bio', 'facebook_url', 'linkedin_url', 'twitter_url', 'is_active', 'is_featured'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];    public function extraDetails()
    {
        return $this->morphMany(ExtraDetail::class, 'detailable')->orderBy('sort_order');
    }
}
