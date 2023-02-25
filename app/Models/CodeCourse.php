<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeCourse extends Model
{
    use HasFactory;
    
    
      public function get_course_id()
    {
        return $this->hasOne('App\Models\Course','id','course_id')->with('lectaures');
    }
    
}
