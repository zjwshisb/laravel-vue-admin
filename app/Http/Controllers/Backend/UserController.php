<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UserController extends BackendController{
    public function index(){
        $user = Auth::user();
        $permissions = $user->is_super  ?  Permission::all() : $user->getPermissionsViaRoles();
        $allows = [];
        foreach ($permissions as $per) {
            $allows[] = $per->name;
        }
        $data = [
            'user'=>$user,
            'permissions'=>$allows
        ];
        return $this->success($data);
    }
}