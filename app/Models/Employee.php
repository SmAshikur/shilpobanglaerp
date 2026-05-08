<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'company_id', 'department_id', 'designation_id', 'user_id',
        'employee_id', 'name', 'email', 'phone', 'joining_date',
        'basic_salary', 'gender', 'address', 'image', 'is_active'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'is_active'    => 'boolean',
    ];

    // Auto-generate employee ID
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($employee) {
            if (empty($employee->employee_id)) {
                $latest = static::withTrashed()->latest('id')->first();
                $nextId = $latest ? ($latest->id + 1) : 1;
                $employee->employee_id = 'EMP-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function company()     { return $this->belongsTo(Company::class); }
    public function department()  { return $this->belongsTo(Department::class); }
    public function designation() { return $this->belongsTo(Designation::class); }
    public function user()        { return $this->belongsTo(User::class); }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
