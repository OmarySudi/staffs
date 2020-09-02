<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseStaff extends Model
{
    //
    protected $fillable = [
        'course_id', 
        'staff_id',
    ];

    protected $table = 'course_staff';
}
