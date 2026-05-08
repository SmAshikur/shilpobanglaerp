<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'company_id', 'name', 'company_name',
        'email', 'phone', 'address',
        'industry', 'website', 'status', 'note',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
