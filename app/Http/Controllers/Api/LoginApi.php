<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\User as UserModel;

class LoginApi extends BaseApi
{
    protected function login(Request $request)
    {
        $validator=Validator::make($request->all(),$this->usernameLoginRule(),$this->loginMessage());

        //获取验证错误信息
        if($validator->fails()){
            $this->response($validator->getMessageBag(),500,'failed');
        }

        $user=UserModel::where(['name'=>$request->name])->first();
        if($user && Hash::check($request->password,$user->password)){
            return $this->response($user);
        }

        return $this->response($user,500,'failed');
    }

    protected function usernameLoginRule()
    {
        return [
            "name"=>"required",
            "password"=>"required"
        ];
    }

    protected function mobileLoginRule()
    {
        return [
            "mobile"=>"required",
            "password"=>"password",
        ];
    }

    protected function loginMessage()
    {
        return [
            "name.required"=>"用户名不能为空",
            "mobile.required"=>"请填写手机号",
            "mobile.regex"=>"请输入正确的手机号",
            "password.required"=>"请输入密码",
        ];
    }
}
