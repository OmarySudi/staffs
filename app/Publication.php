<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    protected $fillable=['staff_id','type_id'];

    protected $table = "publications";
}
