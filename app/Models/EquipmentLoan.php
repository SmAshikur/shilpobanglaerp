<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentLoan extends Model
{
    protected $fillable = ['asset_id', 'employee_id', 'loan_date', 'return_date', 'status', 'health_on_loan', 'health_on_return'];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
