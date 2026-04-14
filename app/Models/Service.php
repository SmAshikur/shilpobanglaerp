<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'image', 'is_active'];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }
}
