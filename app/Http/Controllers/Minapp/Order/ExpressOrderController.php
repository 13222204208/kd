<?php

namespace App\Http\Controllers\Minapp\Order;

use App\Models\ExpressOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpressOrderController extends Controller
{
    public function storeOrder(Request $request)
    {
        try {
            $data = $request->all(); 
            $validator = Validator::make(//验证数据字段
                $data,
                [
                    'send_name' => 'required|max:20',
                    'send_address' => 'required',
                    'send_detailed_address' => 'required|max:120',
                    'send_phone' => 'required|max:20',

                    'get_name' => 'required|max:20',
                    'get_phone' => 'required',
                    'get_address' => 'required|max:120',
                    'get_detailed_address' => 'required|max:20',

                    'goods_type_id' => 'required|max:120',
                    'cost' => 'required|integer',
                ],
                [
                    'required' => ':attribute不能为空',
                    'max' => ':attribute最多20位',
                    'integer'=> ':attribute为整数'
                ],
                [
                    'send_name' => '发货人姓名',
                    'send_address' => '发货人地址',
                    'send_detailed_address' => '发货人详细地址',
                    'send_phone' => '发货人手机号',

                    'get_name' => '收货人姓名',
                    'get_phone' => '收货人手机号',
                    'get_address' => '收货人地址',
                    'get_detailed_address' => '收货人详细地址',

                    'goods_type_id' => '物品类型',
                    'cost' => '劳务费',
                ]        
            );
          
            if ($validator->fails()) {
                $messages = $validator->errors()->first();
                return $this->failed($messages);
            }
            unset($data['token']);
            $user= auth('api')->user();
            $data['user_id']= $user->id;
            $data['order_num']= "K".date('YmdHis',time()).rand(11,99);
            ExpressOrder::create(array_filter($data));

            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function orderList(Request $request)
    {
        try {
            $user= auth('api')->user();
            if(intval($request->order_id) != 0){
               $data= ExpressOrder::where('user_id',$user->id)->where('id',intval($request->order_id))->first();
               return $this->success($data);
            }

            $size = 10;
            if($request->size){
                $size = $request->size;
            }
    
            $page = 0;
            if($request->page){
                $page = ($request->page -1)*$size;
            }
            if(intval($request->is_pay) == 0){
                return $this->failed('缺少是否支付参数');
            }

            $data= ExpressOrder::where('user_id',$user->id)->where('status',intval($request->is_pay))->skip($page)->take($size)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
