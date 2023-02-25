<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $fillable=[
        'name'

   ];


    public function customers()
{
    return $this->belongsTo(Customer::class);
}

public function codes()
{
    return $this->belongsToMany(Code::class,'code_courses','code_id','course_id');
}

public function lectaures()
{
    return $this->hasMany(Lectaure::class);
}



}
