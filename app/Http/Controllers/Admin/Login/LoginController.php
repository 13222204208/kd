<?php

namespace App\Http\Controllers\Admin\Login;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $user= Admin::where('username',$data['username'])->first();

        if(!$user){
            return  $this->failed('用户不存在');
          }
  
          if (!Hash::check($data['password'],$user->password)) {
              return  $this->failed('密码不正确');
          }
          
          if (! $token = auth('admin')->attempt($data)) {
              return  $this->failed();
          }
          $xToken['token'] = $token;
          return $this->success($xToken);
    }

    public function info()
    {
        $user= auth('admin')->user();
        return $this->success($user);
    }

    public function logout()
    {
        return $this->success();
    }
}
