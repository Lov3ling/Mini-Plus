<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Common\Facade\EasySms;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\Exceptions\Exception;
use Illuminate\Support\Facades\Validator;

/**
 * Sms短信
 * Class SmsApi
 * @package App\Http\Controllers\Api
 */
class SmsApi extends BaseApi
{
    /**
     * 发送短信验证码
     * @param Request $request
     */
    protected function send(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->rule(),$this->message());

        //获取验证错误信息
        if($validator->fails()){
            $this->response($validator->getMessageBag(),500,'failed');
        }

        if(Cache::has("Sms_{$request->mobile}")){
            $this->response("请稍后重试",500,'failed');
        }

        //生成验证码
        $code = str_pad(random_int(1, 9999), 6, 0, STR_PAD_LEFT);

        //发送短信
        try{
            $result=EasySms::send($request->mobile,[
                'template'=>90634,
                'data'=>[
                    'code'=>$code,
                    'm'=>3
                ]
            ]);
        }catch (Exception $exception){
            $result=$exception->getExceptions();
            $this->response($result,500,'failed');
        }

        //写入缓存
        Cache::add("Sms_{$request->mobile}",$code,3);
        $this->response($result);
    }

    /**
     * 验证规则
     * @return array
     */
    protected function rule()
    {
        return [
            "mobile"=>"required|regex:/^1[34578][0-9]{9}$/",
        ];
    }

    /**
     * 验证错误信息
     * @return array
     */
    protected function message()
    {
        return [
            "mobile.required"=>"请填写手机号",
            "mobile.regex"=>"请输入正确的手机号",
        ];
    }
}
