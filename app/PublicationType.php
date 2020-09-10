<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    //
    protected $fillable = ['name'];
    
    protected $table = "publication_types";

}
