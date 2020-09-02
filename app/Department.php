<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    protected $fillable = ['name'];

    public function staffs(){

        return $this->hasMany('App\Staff');
    }

    public function courses(){

        return $this->hasMany('App\Course');
    }
}
