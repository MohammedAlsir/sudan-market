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
    // Login Api For Users
    Route::post('user/login','UserController@login');
    // Regestration Function  
    Route::get('user/register','UserController@register');
});
// End   Api Here
