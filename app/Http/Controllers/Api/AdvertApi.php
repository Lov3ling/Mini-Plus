<?php

namespace App\Http\Controllers\Api;

use App\Common\Mini;
use App\Model\Advert;
use Illuminate\Http\Request;

class AdvertApi extends BaseApi
{

    protected function lists(Request $request)
    {
        $map=Mini::getMap($request);
        $result=Advert::where($map)
            ->orderBy('sort','desc')
            ->orderBy('created_at','desc')
            ->get();
        if(count($result)){
            return $this->response($result);
        }
        return $this->response($result,500,'failed');
    }
}
