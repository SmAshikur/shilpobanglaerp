<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title', 'description', 'image', 'service_id', 'project_url', 'is_active'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
