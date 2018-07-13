<?php
namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends BackendController{

    public function store(Request $request){
        $username = $request->username;
        $password = $request->password;
        $admin = Admin::where([
            'username'=>$username,
        ])->first();
        if ( $admin && Hash::check($password,$admin->password)) {
            $token = str_random(40);
            $admin->api_token = $token;
            $admin->expire_time = date("Y-m-d H:i:s",time()+ 30 * 60);
            $admin->last_login_at = date("Y-m-d H:i:s");
            if($admin->save()){
                return $this->success($token,'token');
            }
            return $this->error('发生未知错误');
        }
        return $this->fail('账号密码错误');
    }
}

