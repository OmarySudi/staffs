<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmploymentHistory extends Model
{
    //
    protected $fillable = [
        'position', 
        'place',
        'start_year',
        'end_year'
    ];

    protected $table = 'employment_histories';

    public function staff(){

        return $this->belongsTo('App\Staff');
    }
}
