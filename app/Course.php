<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function studentCourse(){
        return $this->belongsTo('App\StudentCourse')->withDefault();
    }
    public function programme(){
        return $this->belongsTo('App\Programme')->withDefault();
    }
}
