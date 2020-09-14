<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = [
        'name', 
        'number',
        'address',
    ];

    protected $table = 'staffs';

    public function educationHistories(){

        return $this->hasMany('App\EducationHistory');
    }

    public function employmentHistories(){

        return $this->hasMany('App\EmploymentHistory');

    }

    public function courses(){

        return $this->belongsToMany('App\Course');
    }

    public function projects(){

        return $this->hasMany('App\Project');
    }

    public function publications(){

        return $this->belongsToMany('App\Publication');
    }

    public function roles(){

        return $this->belongsToMany('App\Role');
    }
}
