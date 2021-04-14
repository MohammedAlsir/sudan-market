<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;




class UserController extends Controller
{
  protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
  
     /*****************************************************************************************************
     * 
     *                                   Begin Login Function 
     * 
     *****************************************************************************************************/
    public function login(Request $request){
        $user = User::where('phone', '=', $request->input('phone'))->first();
        if($user != null){// for test user not empty
          if(Hash::check($request->input('password'), $user->password))
          {
            $token = Str::random(60);// token generation لتوليد توكن لتمييز المستخدمين
            $user->forceFill([
                'remember_token' => $token,
            ])->save(); // حفظ التوكن في قاعدة البيانات 
            return response()->json(
              ['error'=>false,
              'message'=>'',
              'data'=>$user]
              ,200); // رقم الهاتف وكلمة المرور صحيحة وارجاع رسالة 200 
          }else{
                return response()->json(
                  ['error'=> true,
                  'message'=>'The Password Is Wrong',
                  'code'=> 0 ]
                  ,401); // خطأ في كلمة المرور
               }
        } else{
                return response()->json(
                  ['error'=> true,
                  'message'=>'Phone Number Is Incorrect' ,
                  'code'=> 1 ]
                  ,401); // خطأ في رقم الهاتف 
              }
    } 
     /*****************************************************************************************************
     * 
     *                                   End  Login Function 
     * 
     *****************************************************************************************************/
    /*****************************************************************************************************
     * 
     *                                   Begin Regester Function 
     * 
     *****************************************************************************************************/
    public function Register(Request $request)
    {
        $user = User::where('phone', '=', $request->input('phone'))->first();
        if($user == null){

          // $request->validate([
          //   // 'phone' => ['required', 'min:10', 'max:10', Rule::unique("users")->ignore($user->id, "id")],
          //   'full_name' => 'required',
          //   'address' => 'required',
          //   'password' => 'required',
          //   'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          //   ]);
    
          $imageName =null;
          if($request->img){
            if(filesize($request->img)>2e+6){
              return response()->json(['error'=>false,
                                       'message'=>"The Image Is Too Big",
                                       'code'=>8], 401);
            }else
            $imageName = time().'.'.$request->img->extension();  
            $request->img->move(public_path('images'), $imageName);
          }
        
  
        /* Store $imageName name in DATABASE from HERE */
                $new_user = User::create([ //انشاء مستخدم جديد
                                'full_name' => $request['full_name'],
                                'phone' => $request['phone'],
                                'level' => '2',
                                'password' => Hash::make($request['password']),
                                'remember_token' => Str::random(60),
                                'img' =>$imageName
                            ]);
                            return response()->json(
                              ['error'=>false,
                              'message'=>'',
                              'data'=>$new_user],201);
            
            
        }else
            return response()->json(
              ['error'=>true,
              'message'=> 'The Phone Is Duplicated...',
              'code'=> 4  ]
              ,400); //يوجد مستخدم بهذا الرقم

              
    }
   
 
     /*****************************************************************************************************
     * 
     *                                   End  Regester Function 
     * 
     *****************************************************************************************************/
   
      /*****************************************************************************************************
     * 
     *                                   Begin  Profile Function 
     * 
     *****************************************************************************************************/
     public function profile(Request $request , $id){
        
        $user = User::find($id);

        if($user == null)
          return response()->json([
            'error'=> true,
            'message'=>'Phone Number Is Incorrect' ,  //الهاتف غير صحيح
            'code'=> 1  ],
              404);
        else{

          
            $request->validate([
              'phone' => ['required', 'min:10', 'max:10', Rule::unique("users")->ignore($user->id, "id")],
              'full_name' => 'required',
              'address' => 'required',
              'password' => 'required',
              // 'img' => 'required',
              ]);
              

         $user->full_name=$request->input('full_name');
         $user->phone=$request->input('phone');
         $user->password=$request->input('password');
         $user->address=$request->input('address');
        //  $user->img=$request->input('img');
         $user->save();

          // $user->fill($request->all())->save();
          return response()->json([
          'error'=>false,
          'message'=>'',
          'data'=>$user],200);
        }
    }
     /*****************************************************************************************************
     * 
     *                                   End  Profile Function 
     * 
     *****************************************************************************************************/
    
}
