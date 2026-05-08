<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = ['employee_id', 'rating', 'feedback', 'review_date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
