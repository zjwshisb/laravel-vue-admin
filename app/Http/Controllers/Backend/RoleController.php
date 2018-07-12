<?php
namespace App\Http\Controllers\Backend;

use Spatie\Permission\Models\Role;

/**
 * Class RoleController
 * @package App\Http\Controllers\Backend
 */
class RoleController extends BackendController{
    public function index(){
        return $this->success(Role::all(),'roles');
    }
}