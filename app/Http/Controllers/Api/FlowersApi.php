<?php

namespace App\Http\Controllers\Api;

use App\Common\Mini;
use App\Model\Flowers;
use App\Model\FlowersType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FlowersApi extends BaseApi
{
    /**
     * 查询鲜花分类
     * @param Request $request
     */
    protected function getType(Request $request)
    {
        $map=Mini::getMap($request);

        $result=FlowersType::where($map)
            ->orderBy('created_at','desc')
            ->paginate($request->limit);

        if($result){
           return $this->response($result);
        }else
        {
            return$this->response($result,500,'failed');
        }
    }

    /**
     * 查询鲜花列表
     * @param Request $request
     */
    protected function lists(Request $request)
    {
        //获取查询条件
        $map=Mini::getMap($request,['type_id','id']);

        $result=Flowers::where($map)
            ->orderby('created_at','desc')
            ->paginate($request->limit);

        if($result){
            return $this->response($result);
        }else
        {
            return$this->response($result,500,'failed');
        }
    }

    /**
     * 获取详情
     * @param Request $request
     */
    protected function details(Request $request)
    {

        $result=Flowers::with('type')->find($request->id);
        if($result){
            return $this->response($result);
        }else
        {
            return$this->response($result,500,'failed');
        }
    }
}
