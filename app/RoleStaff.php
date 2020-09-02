<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleStaff extends Model
{
    //
    protected $fillable = [
        'role_id', 
        'staff_id',
    ];

    protected $table = 'role_staff';
}
