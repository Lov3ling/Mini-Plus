<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    Route::group(['prefix'=>'member'],function(){
        Route::resource('users',Member\UserController::class);
    });

    Route::group(['prefix'=>'store'],function (){
        Route::resource('flowers', Store\FlowersController::class);
        Route::resource('type', Store\FlowersTypeController::class);
        Route::resource('advert', Store\AdvertController::class);

    });

});
