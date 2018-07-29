<?php

use App\Model\FlowersType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::any('/test', function (Request $request) {

    $map=$request->only(['id','name']);

    DB::enableQueryLog();

    \App\Model\Flowers::where($map)->get();

    return response()->json(DB::getQueryLog());

    return \App\Model\Flowers::with('type')->first();

    $file=$request->file('file');

    //获取文件名
    $name=$file->getClientOriginalName();

    //获取文件类型
    $ext=$file->getClientOriginalExtension();

    //获取文件MD5
    $md5=md5_file($file);

    //获取mimeType
    $mime=$file->getMimeType();

    //获取文件sha1
    $sha1=sha1_file($file);

    $result=Storage::disk('qiniu')->writeStream($file->hashName('/jasmine'),fopen($file->getRealPath(),'r'));

    dd($result);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
