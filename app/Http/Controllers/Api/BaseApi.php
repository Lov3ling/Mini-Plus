<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class BaseApi extends Controller
{
    public $request;

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
        $response['data']=$data;
        $response['code']=$code;
        $response['message']=$msg;
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
