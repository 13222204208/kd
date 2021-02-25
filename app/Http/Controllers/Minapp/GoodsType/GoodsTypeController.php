<?php

namespace App\Http\Controllers\Minapp\GoodsType;

use App\Models\GoodsType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsTypeController extends Controller
{
    public function goodsType()
    {
        try {
            $data= GoodsType::where('status',1)->get(['title']);
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
