<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $fillable=[
        'number'

        ];
     public function get_code_course()
    {
        return $this->hasMany('App\Models\CodeCourse','code_id','id')->with('get_course_id');
    }
    public function course()

    {
        return $this->belongsToMany(Course::class,'code_courses','code_id','course_id');
    }

    public function customer()

    {
        return $this->belongsTo(User::class);
    }
}
