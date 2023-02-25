<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Coupon;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    //TODO : validation in authentication order
    public function index()
    {

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


    public function update(Request $request)
    {

    }


    public function destroy($id)
    {

    }

    public function checkCode(Request  $request)  
    {
        $data = $request->validate([
            'number'=>'required|max:255',
        ]);
        $user = auth()->user() ?? null;
        if($user <> null)
        {
            $corse_number = $user['get_code'];
            if($request['number'] == $corse_number['number'])
            {
                return $corse_number['get_code_course'];
            }
            return "Unvalid Code";
        }
        return "not auth";




    }


}
