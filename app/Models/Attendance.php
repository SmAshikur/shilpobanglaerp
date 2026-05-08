<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'check_in',
        'check_out',
        'break_start',
        'break_end',
        'break_minutes',
        'status',
        'note'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
