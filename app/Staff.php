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
}
