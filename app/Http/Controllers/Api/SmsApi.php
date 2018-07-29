<?php

namespace App\Http\Controllers\Api;

use App\Model\User;
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
     * 发送注册短信验证码
     * @param Request $request
     */
    protected function register(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->registerRule(),$this->message());

        //获取验证错误信息
        if($validator->fails()){
            return $this->response($validator->getMessageBag(),500,'failed');
        }

        //是否已经存在验证码
        if(Cache::has("Sms_{$request->mobile}")){
            return $this->response("请稍后再试",500,'failed');
        }

        //生成验证码
        $code = str_pad(random_int(1, 9999), 6, 0, STR_PAD_LEFT);

        //发送短信
        try{
            $result=EasySms::send($request->mobile,[
                'template'=>90634,
                'data'=>[
                    'code'=>$code,
                    'm'=>30
                ]
            ]);
        }catch (Exception $exception){
            $result=$exception->getExceptions();
            return $this->response($result,500,'failed');
        }

        //写入缓存
        Cache::add("Sms_{$request->mobile}",$code,30);
        return  $this->response($result);
    }


    /**
     * 找回密码验证码
     * @param Request $request
     */
    protected function forget(Request $request)
    {
        //验证表单
        $validator=Validator::make($request->all(),$this->forgetRule(),$this->message());

        //获取验证错误信息
        if($validator->fails()){
           return  $this->response($validator->getMessageBag(),500,'failed');
        }
        //是否已经存在验证码
        if(Cache::has("Sms_{$request->mobile}")){
            return $this->response("请稍后再试",500,'failed');
        }

        $user=User::where(['mobile'=>$request->mobile])->first();

        //验证号码是否注册
        if(!is_null($user)){
            //是否存在验证码
            if(Cache::has("Sms_{$user->mobile}")){
                return  $this->response("请稍后再试",500,'failed');
            }
            //生成验证码
            $code = str_pad(random_int(1, 9999), 6, 0, STR_PAD_LEFT);
            //发送短信
            try{
                $result=EasySms::send($user->mobile,[
                    'template'=>90634,
                    'data'=>[
                        'code'=>$code,
                        'm'=>30
                    ]
                ]);
            }catch (Exception $exception){
                $result=$exception->getExceptions();
                return $this->response($result,500,'failed');
            }
            Cache::add("Sms_{$request->mobile}",$code,30);

            return $this->response($result);
        }
        return $this->response('此号码暂未注册',500,'failed');

    }

    /**
     * 注册验证规则
     * @return array
     */
    protected function registerRule()
    {
        return [
            "mobile"=>"required|regex:/^1[34578][0-9]{9}$/|unique:users",
        ];
    }

    protected function forgetRule()
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
            "mobile.unique"=>"此号码已经注册",
        ];
    }
}
