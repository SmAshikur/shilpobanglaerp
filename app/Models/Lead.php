<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = ['company_id', 'name', 'email', 'phone', 'stage', 'source', 'assigned_to'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
