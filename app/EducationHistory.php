<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationHistory extends Model
{
    //
    protected $fillable = [
        'course', 
        'year',
        'university',
        'award_acronym',
        'award'
    ];

    protected $table = 'education_histories';

    public function staff(){

        return $this->belongsTo('App\Staff');
    }
}
