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
        Route::post('register','Api\RegisterApi@register');                  //用户注册
        Route::post('login','Api\LoginApi@login');                           //用户登录(用户名)
        Route::post('login_mobile','Api\LoginApi@loginWithMobile');          //用户登录(手机号)
        Route::post('forget','Api\ForgetApi@forget');                        //找回密码

    });

    //通用接口
    Route::group(['prefix'=>'basic'],function(){

        //广告
        Route::group(['prefix'=>'advert'],function(){
            Route::get('lists','Api\AdvertApi@lists');         //获取广告列表
        });

        //验证码
        Route::group(['prefix'=>'sms','middleware'=>'throttle:10,120'],function(){
            Route::post('register','Api\SmsApi@register');      //注册验证码
            Route::post('forget','Api\SmsApi@forget');          //找回密码验证码
        });
    });

    //花店接口
    Route::group(['prefix'=>'store'],function(){
        Route::get('/flowers_type','Api\FlowersApi@getType');      //获取分类列表
        Route::get('/lists','Api\FlowersApi@lists');               //获取鲜花列表
        Route::get('/details','Api\FlowersApi@details');           //获取鲜花详情
    });

});