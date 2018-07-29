<?php
namespace App\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Jasmine
{
    public function test(Request $request)
    {
        dd($request);
    }

    /**
     * 检查验证码是否正确
     * @param string $mobile
     * @param string $code
     * @return bool
     */
    public function checkSmsCode(string $mobile, string $code):bool
    {
        return Cache::get("Sms_{$mobile}")==$code;
    }


    /**
     * 获取查询参数
     * @param Request $request
     * @param array $map
     * @return array
     */
    public function getMap(Request $request,$map=[]){

        return array_merge($request->only($map),["status"=>1]);

    }


}