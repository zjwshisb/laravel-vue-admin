<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\LoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokenController extends BaseController {

    public function store(LoginRequest $request) {
        $admin = Admin::query()->where('username', $request->username)->first();
        if($admin && Hash::check($request->password, $admin->password)) {
            $admin->auth_token = Str::random(32);
            $admin->save();
            return $this->success([
                'token' => $admin->auth_token
            ]);
        }
        return $this->fail('账号密码错误', 1);
    }

    public function index() {
        return 'test';
    }

}
