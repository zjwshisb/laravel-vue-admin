<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;

class UserController extends BackendController{
    public function index(){
        $user = Auth::user();
        $data = [
            'user'=>$user,
            'permissions'=>['1']
        ];
        return $this->success($data);
    }
}