<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentStaff extends Model
{
    //
    protected $fillable = [
        'department_id', 
        'staff_id',
    ];

    protected $table = 'department_staff';
}
