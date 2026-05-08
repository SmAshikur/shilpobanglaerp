<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['parent_id', 'name', 'email', 'phone', 'address', 'logo', 'type', 'is_active', 'is_mother'];

    public function parent() { return $this->belongsTo(Company::class, 'parent_id'); }
    public function children() { return $this->hasMany(Company::class, 'parent_id'); }
    public function departments() { return $this->hasMany(Department::class); }
    public function designations() { return $this->hasMany(Designation::class); }
    public function employees() { return $this->hasMany(Employee::class); }
}
