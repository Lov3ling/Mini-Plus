<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FlowersType extends Model
{
    protected $table="flowers_type";

    protected $fillable=[
        "id","title","content","status"
    ];

    protected $guarded=[

    ];

    public function getFlowers()
    {
        return $this->hasMany(Flowers::class);
    }
}
