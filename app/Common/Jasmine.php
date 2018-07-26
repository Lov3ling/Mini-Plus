<?php
namespace App\Common;
use Illuminate\Support\Facades\Cache;

class Jasmine
{
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
}