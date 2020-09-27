<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaOfResearch extends Model
{
    //
    protected $fillable = [
        'staff_id', 
        'name',
    ];

    protected $table = 'areas_of_researches';
}
