<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {

      $data = Course::paginate(PAGINATION_COUNT);

      return view('admin.courses.index', ['data' => $data]);
    }

    public function create()
    {
      return view('admin.courses.create');
    }



    public function store(Request $request)
    {
        try{
            $course = new Course();
            $course->name = $request->get('name');

            $course->active = $request->active;
            if($course->save()){
                return redirect()->route('admin.course.index')->with(['success' => 'Course created']);

            }else{
                return redirect()->back()->with(['error' => 'Something wrong']);
            }

        }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
            ->withInput();
        }

    }

    public function edit($id)
    {
        $data=Course::findorFail($id);
        return view('admin.courses.edit', ['data' => $data]);
    }

    public function update(Request $request,$id)
    {
        $course=Course::findorFail($id);
        try{
            $course->name = $request->get('name');
            $course->active = $request->active;
            if($course->save()){
                return redirect()->route('admin.course.index')->with(['success' => 'Course update']);

            }else{
                return redirect()->back()->with(['error' => 'Something wrong']);
            }

        }catch(\Exception $ex){
            return redirect()->back()
            ->with(['error' => 'عفوا حدث خطأ ما' . $ex->getMessage()])
            ->withInput();
        }

    }


    public function delete($id)
    {
        try {

            $item_row = Course::select("name")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = Course::where('id','=',$id)->delete();;

        if ($flag) {
            return redirect()->back()
            ->with(['success' => '   Delete Succefully   ']);
            } else {
            return redirect()->back()
            ->with(['error' => '   Something Wrong']);
            }

            } else {
            return redirect()->back()
            ->with(['error' => '   cant reach fo this data   ']);
            }

       } catch (\Exception $ex) {

            return redirect()->back()
            ->with(['error' => ' Something Wrong   ' . $ex->getMessage()]);
            }
    }
}
