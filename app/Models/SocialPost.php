<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = ['project_id', 'platform', 'schedule_date', 'status', 'post_url', 'reach', 'views'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
