<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Models\Section;

class OperationController extends Controller
{
    /*****************************************************************************************************
     *
     *                                   Begin Products Function
     *
     *****************************************************************************************************/
    public function products(){ // Function Get All Products
        $products = Product::inRandomOrder()->limit(5)->get(); //Get All
        if (count($products) > 0) { // التأكد من وجود منتجات
             return response()->json([
                'error'=>false ,
                'message'=>'' ,
                'data'=>$products],
                    200); // رسالة نجاح // يوجد منتجات حاليا
        }else
            return response()->json([
                'error'=>true ,
                'message'=>'Sorry, There Are No Products Currently' ,
                'code'=> 4],
                    404);
            // رسالة خطأ // لايوجد منتجات حاليا
    }
    /******************************************************************************************************
     *
     *                                     End Products Function
     *
     ******************************************************************************************************/

    // ====================================================================================================

    /******************************************************************************************************
     *
     *                                    Begin section Function
     *
     *****************************************************************************************************/
    public function sections(){ // Function Get All Section
        $sections = Section::get(); //Get All
        if (count($sections) > 0) { // التأكد من وجود اقسام
             return response()->json([
                 'error'=>false ,
                 'message'=>'' ,
                 'data'=>$sections],
                    200);//
        }else
            return response()->json([
                'error'=>true ,
                'message'=>'Sorry, There Are No Sections Currently' ,
                'code'=> 5],
                    404);
            // رسالة خطأ // لا يوجد اقسام حاليا

    }
    /*****************************************************************************************************
     *
     *                                   End  section Function
     *
     *****************************************************************************************************/

     // ====================================================================================================

    /******************************************************************************************************
     *
     *                                    Begin requests Function
     *
     *****************************************************************************************************/
    public function requests(){ // Function Get All requests
        $requests = ModelsRequest::get(); //Get All
        if (count($requests) > 0) { // التأكد من وجود طلبات
             return response()->json([
                 'error'=>false ,
                 'message'=>'' ,
                 'data'=>$requests],
                    200);//
        }else
            return response()->json([
                'error'=>true ,
                'message'=>'Sorry, There Are No Requests Currently' ,
                'code'=> 6],
                    404);
            // رسالة خطأ // لا يوجد طلبات حاليا

    }
    /*****************************************************************************************************
     *
     *                                   End  requests Function
     *
     *****************************************************************************************************/

    /******************************************************************************************************
     *
     *                                    Begin productSection Function
     *
     *****************************************************************************************************/
    public function productSection($id){ // Function Get All Products By Section
        $products = Product::where('section_id','=',$id )->get(); //Get All By Section

        if (count($products) > 0) { // التأكد من وجود منتجات
             return response()->json([
                 'error'=>false ,
                 'message'=>'' ,
                 'data'=>$products],
                    200);//
        }else
            return response()->json([
                'error'=>true ,
                'message'=>'Sorry, There Are No Products In This Section Currently' ,
                'code'=> 7],
                    404);
            // رسالة خطأ // لا يوجد منتجات في هذا القسم  حاليا

    }
    /*****************************************************************************************************
     *
     *                                   End  productSection Function
     *
     *****************************************************************************************************/


      /******************************************************************************************************
     *
     *                                    Begin SaveRequests Function
     *
     *****************************************************************************************************/
    public function SaveRequests(Request $request){ // Function save new request

        $new_request = ModelsRequest::create([ //انشاء 'طلب' جديد
            'address'           => $request['address'],
            'request_state'     => $request['request_state'],//
            'additional_phone'  => $request['additional_phone'],
            'amount'            => $request['amount'],
            'product_id'        => $request['product_id'],
            'user_id'           => $request['user_id']
        ]);
        return response()->json(
            [
                'error' => false,
                'message' => '',
                'data' => $new_request
            ],
            200
        );

    }
    /*****************************************************************************************************
     *
     *                                   End  SaveRequests Function
     *
     *****************************************************************************************************/

} //End Main Function
