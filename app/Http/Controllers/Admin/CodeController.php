<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function index()
    {

     $data = Code::with('course','customer')->get();

      return view('admin.codes.index', ['data' => $data]);
    }

    public function create()
    {
        $courses=Course::get();
        $customers=User::get();
      return view('admin.codes.create')->with([
        'courses'=>$courses,
        'customers'=>$customers,
      ]);
    }



    public function store(Request $request)
    {
        try{
            $code = new Code();
            $code->number = $request->get('number');
            $code->customer_id= $request->get('customer');
            $courses = $request->get('course_id');

            if($code->save()){
                foreach ($courses as $course) {
                    $code->course()->attach($course);
                }
                return redirect()->route('admin.code.index')->with(['success' => 'Code created']);

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
        $data=Code::findorFail($id);
        $courses=Course::get();
        $customers=User::get();
        return view('admin.codes.edit', ['data' => $data,'courses'=>$courses,'customers'=>$customers]);
    }

    public function update(Request $request,$id)
    {
        $code=Code::findorFail($id);
        try{
            $code->number = $request->get('number');
            $code->customer_id= $request->get('customer');
            $courses = $request->get('course_id');

            if($code->save()){

                foreach ($courses as $course) {
                    $code->course()->attach($course);
                }
                return redirect()->route('admin.code.index')->with(['success' => 'Code update']);

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

            $item_row = Code::select("number")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = Code::with('course','customer')->where('id','=',$id)->delete();;

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
