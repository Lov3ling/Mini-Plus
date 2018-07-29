<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\FlowersType;

class Flowers extends Model
{
    protected $table="flowers";

    /**
     * 白名单
     * @var array
     */
    protected $fillable=[
        "name","type_id","image","send_money","nums","price","status","original_price"
    ];

    /**
     * 黑名单
     * @var array
     */
    protected $guarded=[

    ];

    /**
     * 反向一对多
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(\App\Model\FlowersType::class,'type_id','id');
    }

    /**
     * type_id访问器
     * @return mixed
     */
    protected function getOwnTypeAttribute()
    {
        return FlowersType::find($this->type_id);
    }
}
