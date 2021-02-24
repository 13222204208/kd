<?php

namespace App\Http\Controllers\Minapp\User;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function storeAddress(Request $request)
    {
        try {
            $data = $request->all(); 
            $validator = Validator::make(//验证数据字段
                $data,
                [
                    'name' => 'required|max:20',
                    'address' => 'required',
                    'detailed_address' => 'required|max:120',
                    'phone' => 'required|max:20',
                    'site' => 'required|max:120',
                    'is_default' => 'required|integer',
                ],
                [
                    'required' => ':attribute不能为空',
                    'max' => ':attribute最多20位',
                    'integer'=> ':attribute为整数'
                ],
                [
                    'name' => '收货人姓名',
                    'address' => '地址',
                    'detailed_address' => '详细地址',
                    'phone' => '手机号',
                    'site' => '站点',
                    'is_default' => '是否默认',
                ]        
            );
          
            if ($validator->fails()) {
                $messages = $validator->errors()->first();
                return $this->failed($messages);
            }
            $user= auth('api')->user();
            $address= new Address();
            $address->name= $data['name'];
            $address->address= $data['address'];
            $address->detailed_address= $data['detailed_address'];
            $address->phone= $data['phone'];
            $address->site= $data['site'];
            $address->is_default= $data['is_default'];
            $address->user_id= $user->id;
            $address->save();
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function addressList(Request $request)
    {
        try {
            $user= auth('api')->user();
            if(intval($request->address_id) != 0){
               $data= Address::where('user_id',$user->id)->where('id',intval($request->address_id))->first();
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

            $data= Address::where('user_id',$user->id)->skip($page)->take($size)->get();
            return $this->success($data);
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function delAddress(Request $request)
    {
        try {
            $user= auth('api')->user();
            $address_id= $request->address_id;
            $addressID= array_filter(explode(',',$address_id));
            Address::where('user_id',$user->id)->whereIn('id',$addressID)->delete();
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }

    public function updateAddress(Request $request)
    {
        try {
            $data = $request->all(); 
            $validator = Validator::make(//验证数据字段
                $data,
                [
                    'name' => 'required|max:20',
                    'address' => 'required',
                    'detailed_address' => 'required|max:120',
                    'phone' => 'required|max:20',
                    'site' => 'required|max:120',
                    'is_default' => 'required|integer',
                ],
                [
                    'required' => ':attribute不能为空',
                    'max' => ':attribute最多20位',
                    'integer'=> ':attribute为整数'
                ],
                [
                    'name' => '收货人姓名',
                    'address' => '地址',
                    'detailed_address' => '详细地址',
                    'phone' => '手机号',
                    'site' => '站点',
                    'is_default' => '是否默认',
                ]        
            );
          
            if ($validator->fails()) {
                $messages = $validator->errors()->first();
                return $this->failed($messages);
            }
            $user= auth('api')->user();
            unset($data['token']);
            $addressID= $data['address_id'];
            unset($data['address_id']);

            Address::where('user_id',$user->id)->where('id',$addressID)->update($data);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
