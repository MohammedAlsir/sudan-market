<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Begin Api From Here
Route::group(['namespace' => 'App\Http\Controllers\Api'], function(){
    // Login Api For Users ==> Send phone & password
    Route::post('user/login','UserController@login');

    // Regestration Function ==> Send full_name & phone & password  
    Route::post('user/register','UserController@register');
    // Edit User Data  ==> Send All Data
    Route::post('user/{id}/profile', 'UserController@profile');

    // Get All products 
    Route::get('products', 'OperationController@products');
    // Get All Sections 
    Route::get('sections', 'OperationController@sections');
    // Get All Request 
    Route::get('requests', 'OperationController@requests');
     
});
// End   Api Here
