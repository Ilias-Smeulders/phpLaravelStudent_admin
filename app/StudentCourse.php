<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    public function course(){
        return $this->belongsTo('App\Course')->withDefault();
    }
    public function student(){
        return $this->belongsTo('App\Student')->withDefault();
    }
}
