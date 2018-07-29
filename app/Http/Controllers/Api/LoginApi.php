<?php

namespace App\Http\Controllers\Api;

use App\Common\Mini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\User as UserModel;

/**
 * 登录接口
 * Class LoginApi
 * @package App\Http\Controllers\Api
 */
class LoginApi extends BaseApi
{
    /**
     * 用户名登录
     * @param Request $request
     */
    protected function login(Request $request)
    {
        $validator=Validator::make($request->all(),$this->usernameLoginRule(),$this->loginMessage());

        //获取验证错误信息
        if($validator->fails()){
            return $this->response($validator->getMessageBag(),500,'failed');
        }

        $map=Mini::getMap($request,['name']);

        $user=UserModel::where($map)->first();
        if($user && Hash::check($request->password,$user->password)){
            return $this->response($user,200,'success');
        }

        return $this->response(null,500,'failed');
    }

    /**
     * 手机号登录
     * @param Request $request
     */
    protected function loginWithMobile(Request $request)
    {
        $validator=Validator::make($request->all(),$this->mobileLoginRule(),$this->loginMessage());

        //获取验证错误信息
        if($validator->fails()){
            return $this->response($validator->getMessageBag(),500,'failed');
        }

        $map=Mini::getMap($request,['mobile']);

        $user=UserModel::where($map)->first();


        if(!is_null($user) && Hash::check($request->password,$user->password)){
            return $this->response($user,200,'success');
        }

        return $this->response(null,500,'failed');
    }

    /**
     * 用户名登录验证
     * @return array
     */
    protected function usernameLoginRule()
    {
        return [
            "name"=>"required",
            "password"=>"required"
        ];
    }


    /**
     * 手机号登录验证
     * @return array
     */
    protected function mobileLoginRule()
    {
        return [
            "mobile"=>"required",
            "password"=>"required",
        ];
    }

    /**
     * 验证错误信息
     * @return array
     */
    protected function loginMessage()
    {
        return [
            "name.required"=>"请填写用户名",
            "mobile.required"=>"请填写手机号",
            "mobile.regex"=>"请输入正确的手机号",
            "password.required"=>"请输入密码",
        ];
    }
}
