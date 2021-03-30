<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;


class UserController extends Controller
{
    // Begin Login Function
    public function login(Request $request){
        $user = User::where('phone', '=', $request->input('phone'))->first();
        if($user != null){// for test user not empty
          if($request->input('password') == $user->password){
            $token = Str::random(60);// token generation لتوليد توكن لتمييز المستخدمين
            $user->forceFill([
                'remember_token' => $token,
            ])->save(); // حفظ التوكن في قاعدة البيانات 
            return response()->json(['error'=>false,'message'=>'','data'=>$user] ,200); // رقم الهاتف وكلمة المرور صحيحة وارجاع رسالة 200 
          }else{
                return response()->json(['error'=> true,'message'=>'The password is wrong','code'=> 0 ],401); // خطأ في كلمة المرور
               }
        } else{
                return response()->json(['error'=> true,'message'=>'Phone number is incorrect' ,'code'=> 1 ],401); // خطأ في رقم الهاتف 
              }
    }// End Login Function 
    /**
     * 
     * 
     * END
     *  
     * 
     **/
    public function Register(Request $request)
    {
        $user = User::where('phone', '=', $request->input('phone'))->first();
        if($user == null){
                $new_user = User::create([ //انشاء مستخدم جديد
                                'full_name' => $request['full_name'],
                                'password' => $request['password'],
                                'phone' => $request['phone'],
                                'level' => '2',
                                'remember_token' => Str::random(60),
                            ])->save();
                            return response()->json(['error'=>false,'message'=>'','data'=>$new_user],201);
            
            
        }else
            return response()->json(['error'=>true,'message'=> 'The phone is duplicated...','code'=> 4  ],400); //يوجد مستخدم بهذا الرقم
    }
    
}
