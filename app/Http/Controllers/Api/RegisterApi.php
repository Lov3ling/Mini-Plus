<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Model\User as UserModel;
use Illuminate\Support\Facades\Validator;

/**
 * 注册接口
 * Class RegisterApi
 * @package App\Http\Controllers\Api
 */
class RegisterApi extends BaseApi
{
    /**
     * 注册
     * @param Request $request
     * @return JsonResponse
     */
    protected function register(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->registerRule(),$this->registerMessage());

        //获取验证错误信息
        if($validator->fails()){
            $this->response($validator->getMessageBag(),500,'failed');
        }

        //入库
        if($result=UserModel::create($request->all())){
            $result->password=bcrypt($result->password);
            $result->save();
            return $this->response($result,200,'success');
        }else{
            return $this->response($result,500,'error');
        }
    }

    /**
     * 验证规则
     * @return array
     */
    protected function registerRule()
    {
        return [
            "name"=>"required|min:5|alpha_dash|unique:users",
            "mobile"=>"required|regex:/^1[34578][0-9]{9}$/|unique:users",
            "password"=>"required|min:8"
        ];
    }

    /**
     * 验证错误信息
     * @return array
     */
    protected function registerMessage()
    {
        return [
            "name.required"=>"用户名不能为空",
            "name.min"=>"用户名长度必须5位以上",
            "name.alpha_dash"=>"用户名只能使用字母、数字、以及下划线",
            "name.unique"=>"用户名已经被使用",
            "mobile.required"=>"请填写手机号",
            "mobile.regex"=>"请输入正确的手机号",
            "mobile.unique"=>"手机号已经被注册",
            "password.required"=>"密码不能为空",
            "password.min"=>"密码最少8位"
        ];
    }
}
