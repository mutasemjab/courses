<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use App\Http\Requests\CustomerRequest;




class CustomerController extends Controller
{

  public function index()
  {

    $data = User::paginate(PAGINATION_COUNT);

    return view('admin.customers.index', ['data' => $data]);
  }

  public function create()
  {
    return view('admin.customers.create');
  }



  public function store(CustomerRequest $request)
  {
    try{
        $customer = new User();
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone = $request->get('phone');
         $customer->device_id = $request->get('device_id');
        $customer->password = Hash::make($request->password);
        $customer->active = $request->active;
        if($customer->save()){
            return redirect()->route('admin.customer.index')->with(['success' => 'Customer created']);

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
    $data=User::findorFail($id);
    return view('admin.customers.edit',compact('data'));
  }

  public function update(Request $request,$id)
  {
    $customer=User::findorFail($id);
    try{
        $customer->name = $request->get('name');
        $customer->email = $request->get('email');
        $customer->phone = $request->get('phone');
        $customer->device_id = $request->get('device_id');

        $customer->password = Hash::make($request->password);
        $customer->active = $request->active;
        if($customer->save()){
            return redirect()->route('admin.customer.index')->with(['success' => 'Customer update']);

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

            $item_row = User::select("name")->where('id','=',$id)->first();

            if (!empty($item_row)) {

        $flag = User::where('id','=',$id)->delete();;

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


  public function ajax_search(Request $request)
  {
      if ($request->ajax()) {


      $search_by_text = $request->search_by_text;
      $searchbyradio = $request->searchbyradio;

      if ($search_by_text != '') {
      if ($searchbyradio == 'customer_code') {
      $field1 = "customer_code";
      $operator1 = "=";
      $value1 = $search_by_text;
      } elseif ($searchbyradio == 'account_number') {
      $field1 = "account_number";
      $operator1 = "=";
      $value1 = $search_by_text;
      } else {
      $field1 = "name";
      $operator1 = "like";
      $value1 = "%{$search_by_text}%";
      }
      } else {
      //true
      $field1 = "id";
      $operator1 = ">";
      $value1 = 0;
      }


      $data = User::where($field1, $operator1, $value1)->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

      return view('admin.customers.ajax_search', ['data' => $data]);
      }
      }



}
