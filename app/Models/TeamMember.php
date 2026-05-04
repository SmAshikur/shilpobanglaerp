<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = ['name', 'position', 'image', 'bio', 'facebook_url', 'linkedin_url', 'twitter_url', 'is_active'];
}
