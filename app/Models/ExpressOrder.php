<?php

namespace App\Models;

use App\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpressOrder extends Model
{
    use HasFactory, Timestamp;

    protected $guarded = [];

    protected $appends= ['goods_name'];

    public function userInfo()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function getGoodsNameAttribute()
    {
        $arr= explode(',',$this->attributes['goods_type_id']);
        $data= GoodsType::whereIn('id',$arr)->pluck('title'); 
        $str= "";
        foreach ($data as $value) {
            $str .= $value." ";
        }
        return $str;
    }
}
