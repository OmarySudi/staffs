<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

    // protected $fillable = ['name','department_id'];

    // public function staffs(){

    //     return $this->belongsToMany('App\Staff');
    // }

    protected $fillable = [
        'staff_id', 
        'name',
    ];

    protected $table = 'staff_courses';
}
