<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lectaure extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','url', 'data',

   ];

   public function course(){

    return $this->belongsTo(Course::class);
   }
}
