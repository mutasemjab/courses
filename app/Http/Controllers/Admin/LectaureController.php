<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Helpers\General;
use App\Models\Lectaure;
use Illuminate\Http\Request;

class LectaureController extends Controller
{
    public function index()
    {

      $data = Lectaure::with('course')->paginate(PAGINATION_COUNT);

      return view('admin.lectaures.index', ['data' => $data]);
    }

    public function create()
    {
        $courses=Course::get();
      return view('admin.lectaures.create')->with([
        'courses'=>$courses,
      ]);
    }



    public function store(Request $request)
    {
        try{
            $lectaure = new Lectaure();
            $lectaure->name = $request->get('name');
            $lectaure->video = $request->get('video');

            $lectaure->course_id=$request->get('course');
            $lectaure->active = $request->active;

            // $video_lectaure = [];
            // if ($request->video_lectaure) {
            //     $request->validate([
            //     'video_lectaure' => 'required|max:2000',
            //     ]);

            //    foreach ($request->video_lectaure as $vid) {
            //     $path =uploadImage('assets/admin/uploads', $vid);
            //             $video_lectaure[] = $path;
            //         }

            //         $lectaure->video = json_encode($video_lectaure);

            //  }

             $data_lectaure = [];
             if ($request->data_lectaure) {
                 $request->validate([
                 'data_lectaure' => 'required|max:2000',
                 ]);

                foreach ($request->data_lectaure as $da) {
                 $path =uploadImage('assets/admin/uploads', $da);
                         $data_lectaure[] = $path;
                     }

                     $lectaure->data = json_encode($data_lectaure);

              }

            if($lectaure->save()){
                return redirect()->route('admin.lectaure.index')->with(['success' => 'Course created']);

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
        $data=Lectaure::findorFail($id);
        $courses=Course::get();
        return view('admin.lectaures.edit',
        [
            'data' => $data,
            'courses' => $courses,

    ]);
    }

    public function update(Request $request,$id)
    {
        $lectaure=Lectaure::findorFail($id);
        try{
            $lectaure->name = $request->get('name');
            $lectaure->video = $request->get('video');
            $lectaure->course_id=$request->get('course');
            $lectaure->active = $request->active;

            // $video_lectaure = [];
            // if ($request->file('video_lectaure')) {
            //     $request->validate([
            //     'video_lectaure.*' => 'required|max:2000',
            //     ]);
            //     $oldphotoPath = $lectaure->video;
            //     foreach ($request->file('video_lectaure') as $vid) {
            //         $path =uploadImage('assets/admin/uploads', $vid);
            //                 $video_lectaure[] = $path;
            //                 if (file_exists('assets/admin/uploads/' . $oldphotoPath) and !empty($oldphotoPath)) {
            //                     unlink('assets/admin/uploads/' . $oldphotoPath);
            //                     }
            //             }


            //             $lectaure->video = json_encode($video_lectaure);
            //     }

                $data_lectaure = [];
                if ($request->file('data_lectaure')) {
                    $request->validate([
                    'data_lectaure.*' => 'required|max:2000',
                    ]);
                    $oldphotoPath = $lectaure->data;
                    foreach ($request->file('data_lectaure') as $vid) {
                        $path =uploadImage('assets/admin/uploads', $vid);
                                $data_lectaure[] = $path;
                                if (file_exists('assets/admin/uploads/' . $oldphotoPath) and !empty($oldphotoPath)) {
                                    unlink('assets/admin/uploads/' . $oldphotoPath);
                                    }
                            }


                            $lectaure->data = json_encode($data_lectaure);
                    }

            if($lectaure->save()){
                return redirect()->route('admin.lectaure.index')->with(['success' => 'Course update']);

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

            $item_row = Lectaure::select("name")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = Lectaure::where('id','=',$id)->delete();;

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
