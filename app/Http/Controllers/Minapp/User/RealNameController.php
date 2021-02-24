<?php

namespace App\Http\Controllers\Minapp\User;

use App\Models\RealName;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RealNameController extends Controller
{
    use UploadImage;

    public function uploadImg(Request $request)
    {
        try {
            $imgUrl= $this->getNewFile($request->file);
            return $this->success($imgUrl);
        } catch (\Throwable $th) {
            return $this->faild($th->getMessage());
        }
    }

    public function realName(Request $request)
    {
        try {
            $data = $request->all(); 
            $validator = Validator::make(//验证数据字段
                $data,
                [
                    'name' => 'required|max:20',
                    'id_number' => 'required|unique:real_names',
                    //'phone' => 'required|regex:/^1[345789][0-9]{9}$/',
                    'id_front' => 'required',
                    'id_reverse_side' => 'required',
                ],
                [
                    'required' => ':attribute不能为空',
                    'regex' => ':attribute格式不正确',
                    'max' => ':attribute最多20位',
                    'unique'=> ':attribute已提交审核'
                ],
                [
                    'name' => '真实姓名',
                    'id_number' => '身份证号',
                    'id_front' => '身份证正面',
                    'id_reverse_side' => '身份证反面',
                ]        
            );
          
            if ($validator->fails()) {
                $messages = $validator->errors()->first();
                return $this->failed($messages);
            }
            
            $result =  \Ofcold\IdentityCard\IdentityCard::make($request->id_number);//验证身份证号
         
            if ( $result === false ) {
                return $this->failed('你的身份证号码不正确');
            }
    
            $user= auth('api')->user();
            $realName= new RealName;
            $realName->id_number= $data['id_number'];
            $realName->id_front= $data['id_front'];
            $realName->name= $data['name'];
            $realName->id_reverse_side= $data['id_reverse_side'];
            $realName->user_id= $user->id;
            $realName->save();
           return $this->success();
        } catch (\Throwable $th) {
            return $this->failed($th->getMessage());
        }
    }
}
