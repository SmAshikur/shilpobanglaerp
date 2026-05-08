<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutsourcingPayment extends Model
{
    protected $fillable = ['freelancer_name', 'project_id', 'amount', 'status'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
