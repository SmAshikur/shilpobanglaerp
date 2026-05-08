<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['lead_id', 'type', 'description', 'activity_date', 'performed_by'];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function performedBy()
    {
        return $this->belongsTo(Employee::class, 'performed_by');
    }
}
