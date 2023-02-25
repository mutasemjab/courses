<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\UserCoupon;
use Illuminate\Http\Request;

class UserCodeController extends Controller
{



    public function index(){

    }


    public function getForShop($id){

        $userId = auth()->user()->id;

        return Code::getForShop($userId,$id);

    }





    public static function verifyCode($userId,$codeId){
        $code = Code::find($codeId);
        if($code){
            $isCouponUsed = Code::where('customer_id','=',$userId)->where('number','=',$codeId)->exists();
            if($code->for_only_one_time && $isCouponUsed){
                return [
                    "success"=>false,
                    "error"=>"This coupon is already used by you"
                ];
            }
            return [
                "success"=>true
            ];
        }else{
            return [
                "success"=>false,
                "error"=>"This coupon is not available"
            ];
        }


    }



}
