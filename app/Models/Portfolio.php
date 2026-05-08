<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['title', 'description', 'image', 'service_id', 'project_url', 'client_name', 'is_active', 'is_featured'];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function extraDetails()
    {
        return $this->morphMany(ExtraDetail::class, 'detailable')->orderBy('sort_order');
    }
}
