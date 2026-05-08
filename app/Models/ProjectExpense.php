<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectExpense extends Model
{
    protected $fillable = ['project_id', 'category', 'amount', 'expense_date'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
