<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = ['staff_id','title','description','year'];

    protected $table = "projects";
}
