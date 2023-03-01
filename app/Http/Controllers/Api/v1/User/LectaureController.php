<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;


use App\Models\Lectaure;
use Illuminate\Http\Request;

class LectaureController extends Controller
{

    public function index()
    {
       $lectaures = Lectaure::with('course')->get();
        foreach ($lectaures as $lectaure) {
            $lectaure->data = json_decode($lectaure->data, true);
        }


        return $lectaures;
    }

    public function create()
    {

    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $userId = auth()->user()->id;
        $lectaure =  Lectaure::with('course')->find($id)->toArray();

        return $lectaure;

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

}
