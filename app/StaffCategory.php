<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    //

    protected $fillable = ['name'];

    protected $table = 'staff_categories';

    public function staffs(){

        return $this->hasMany('App\Staff');
    }
}
