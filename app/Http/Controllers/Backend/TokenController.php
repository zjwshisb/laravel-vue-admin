<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\LoginRequest;
use App\Models\Admin;
use App\Models\AdminActionLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokenController extends BaseController {

    public function store(LoginRequest $request) {
        $admin = Admin::query()->where('username', $request->username)->first();
        if($admin && Hash::check($request->password, $admin->password)) {
            if($admin->is_forbidden) {
                return $this->fail('账号已禁用', 2);
            }
            $admin->auth_token = Str::random(32);
            $admin->last_login_at = now()->toDateString();
            $admin->save();
            AdminActionLog::query()->create([
                'admin_id' => $admin->id,
                'method'=> $request->getMethod(),
                'action'=> \Route::currentRouteAction(),
                'params'=> $request->all(),
                'route_params' => \Route::current()->parameters,
                'ip'=> $request->getClientIp(),
                'created_at'=> now()->toDateTimeString(),
                'name' => '登录'
            ]);
            return $this->success([
                'token' => $admin->auth_token
            ]);
        }
        return $this->fail('账号密码错误', 1);
    }

    public function index() {
        return '111';
    }

}
