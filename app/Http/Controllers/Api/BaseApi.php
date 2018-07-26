<?php

namespace App\Http\Controllers\Api;

use App\Common\Jasmine;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Common\Facade\EasySms;
use Illuminate\Support\Facades\Session;
use Overtrue\EasySms\Exceptions\Exception;

class BaseApi extends Controller
{
    public $request;

    protected $key='$2y$10$vql16fMvM4/ZlGX9pfWHauougjaXM11Y8SPRacYlD28MjeQ8wey7.';

    public function test(Request $request)
    {
    }

    public function __construct(Request $request)
    {
        $this->request=$request;
    }


    /**
     * Json响应
     * @param array $data
     * @param int $code
     * @param string $msg
     */
    public function response($data=[],$code=200,$msg="success")
    {
        $response['code']=$code;
        $response['message']=$msg;
        $response['date']=date('Y-m-d H:i:s');
        $response['data']=$data;
        response()
            ->json($response)
            ->send();
        dd();
    }


    /**
     * 预处理
     * @param string $method
     * @param array $parameters
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }


}
