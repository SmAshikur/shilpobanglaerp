<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'client_id', 'budget', 'status'];

    public function expenses()
    {
        return $this->hasMany(ProjectExpense::class);
    }
}
