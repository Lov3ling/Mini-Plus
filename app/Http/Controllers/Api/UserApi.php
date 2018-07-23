<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserApi extends BaseApi
{
    public $params=[
        "query"=>[
            "id"
        ]
    ];

    protected function query()
    {
        $this->response(1);
    }

}
