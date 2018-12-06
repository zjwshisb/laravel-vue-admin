<?php
namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class TokenController
 * @package App\Http\Controllers\Backend
 * @author zjw
 */
class TokenController extends BackendController{

    public function store(Request $request){
        $admin = Admin::where([
            'username'=>$request->username,
        ])->first();
        if ( $admin && Hash::check($request->password, $admin->password)) {
            $token = str_random(40);
            $admin->api_token = $token;
            $admin->expire_time = date("Y-m-d H:i:s",time()+ 30 * 60);
            $admin->last_login_at = date("Y-m-d H:i:s");
            $admin->save();
            return ['token'=>$token];
        }
        return [
            'msg' => __('auth.failed')
        ];
    }
}

