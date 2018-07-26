<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\User as UserModel;
use Illuminate\Support\Facades\Validator;

class UploadApi extends BaseApi
{
    /**
     * 文件上传
     * @param Request $request
     */
    public function upload(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->rule(),$this->message());

        //获取验证错误信息
        if($validator->fails()){
            $this->response($validator->getMessageBag(),500,'failed');
        }

        //获取文件
        $file=$request->file('file');

        //获取文件名
        $name=$file->getClientOriginalName();

        //获取文件类型
        $ext=$file->getClientOriginalExtension();

        //获取文件MD5
        $md5=md5_file($file);

        //获取文件sha1
        $sha1=sha1_file($file);

        $result=Storage::disk('qiniu')->writeStream($file->hashName('/jasmine').$ext,fopen($file->getRealPath(),'r'));

        dd($result);


    }

    public function rule()
    {
        return [
            "file"=>"required|file"
        ];
    }

    public function message()
    {
        return [
            "file.required"=>"缺少文件",
            "file.file"=>"缺少文件"
        ];
    }
}