<?php

use Illuminate\Http\Request;

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

//测试专用
Route::any('test',function (Request $request){

});


Route::group(['prefix'=>'v3'],function (){
    Route::any('test','Api\BaseApi@test');

    //用户接口
    Route::group(['prefix'=>'user'],function(){
        Route::post('register','Api\RegisterApi@register');      //用户注册
        Route::post('login','Api\LoginApi@login');         //用户登录
    });

    //常用接口
    Route::group(['prefix'=>'basic'],function(){
        Route::post('sms','Api\SmsApi@send');      //用户注册
    });
});