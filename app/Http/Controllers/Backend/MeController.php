<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ChangePasswordRequest;

class MeController extends BaseController{

    public function index() {
        return [
           'id'=> \Auth::id(),
           'username'=> \Auth::user()->username,
            'pids'=> \Auth::user()->menus->pluck('id'),
            'avatar'=> \Auth::user()->avatar
        ];
    }

    public function password(ChangePasswordRequest $request) {
        $user = \Auth::user();
        $user->password = $request->new_password;
        $user->save();
        return $this->success();
    }
}
