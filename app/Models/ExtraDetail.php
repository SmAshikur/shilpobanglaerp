<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraDetail extends Model
{
    protected $fillable = ['title', 'description', 'sort_order'];

    public function detailable()
    {
        return $this->morphTo();
    }}
