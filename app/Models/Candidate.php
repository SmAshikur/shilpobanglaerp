<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['job_opening_id', 'name', 'email', 'phone', 'resume', 'status'];

    public function jobOpening()
    {
        return $this->belongsTo(JobOpening::class);
    }
}
