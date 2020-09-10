<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffCategory extends Model
{
    //
    protected $fillable = ['name'];

    protected $table = 'staff_categories';
}
