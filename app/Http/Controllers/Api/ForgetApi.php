<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Common\Mini;
use App\Model\User as UserModel;

class ForgetApi extends BaseApi
{

    /**
     * 找回密码
     * @param Request $request
     * @return JsonResponse
     */
    protected function forget(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->rule(),$this->message());

        //获取验证错误信息
        if($validator->fails()){
            return $this->response($validator->getMessageBag(),500,'failed');
        }

        //验证码是否正确
        if(Mini::checkSmsCode($request->mobile,$request->code)!==true)
        {
            return $this->response('验证码错误',300,'error');
        }

        $result=UserModel::where(['mobile'=>$request->mobile])->first();
        //入库
        if(!is_null($result)){
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
    protected function rule()
    {
        return [
            "mobile"=>"required|regex:/^1[34578][0-9]{9}$/",
            "code"=>"required|max:6|min:6",
            "password"=>"required|min:8|confirmed",
        ];
    }

    protected function message()
    {
        return [
            "mobile.required"=>"请填写手机号",
            "mobile.regex"=>"请输入正确的手机号",
            "password.required"=>"密码不能为空",
            "password.min"=>"密码最少8位",
            "password.confirmed"=>"两次密码不一致",
            "code.require"=>"请输入验证码",
        ];
    }
}
