<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Lectaure;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function index()
    {
        return Course::all();
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {

    }


    public function edit($id)
    {


    }


    public function update(Request $request, $id)
    {


    }

    public function destroy(Request $request)
    {

    }


    public function getLectaure($id): array
    {
        $user_id = auth()->user()->id;
       $lectaures = Lectaure::where('course_id',$id)->get();
        $filterlectaures = [];

        foreach($lectaures as $lectaure){

           array_push($filterlectaures,$lectaure);
           $lectaure->data = json_decode($lectaure->data, true);

       }


        return $filterlectaures;
   }

}
