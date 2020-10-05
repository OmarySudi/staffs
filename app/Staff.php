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

        return $this->hasMany('App\Course');
    }

    public function projects(){

        return $this->hasMany('App\Project');
    }

    public function user_skills(){

        return $this->hasMany('App\Skill');
    }

    public function areas(){

        return $this->hasMany('App\AreaOfResearch');
    }

    public function publications(){

        return $this->hasMany('App\Publication');
    }

    public function roles(){

        return $this->belongsToMany('App\Role');
    }
}
