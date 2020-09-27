<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $fillable = [
        'staff_id', 
        'name',
    ];

    protected $table = 'skills';
}
