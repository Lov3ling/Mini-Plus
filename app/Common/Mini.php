<?php
namespace App\Common;

class Mini
{
    public static $object;

    public function __construct()
    {

    }

    public static function register()
    {
        static::$object=new Jasmine();
    }

    public static function __callStatic($method,$args)
    {
        return call_user_func_array([static::$object,$method],$args);
    }
}