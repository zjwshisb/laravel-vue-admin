<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers\Backend
 */
class RoleController extends BackendController
{
    public function index(Request $request)
    {
        $roles = Role::when($name = $request->name,function($query) use ($name){
            $query->where('name',$name);
        })->orderBy('created_at','desc')->paginate($request->size);
        $permissions = Permission::all();
        $group = [];
        foreach ($permissions as $val) {
            $group[$val->group][] = $val;
        }
        return $this->success([
            'roles' => $roles,
            'permissions' => $group
        ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
           'name'=>'required'
        ]);
        if($validator->fails()){
            return $this->fail('表单填写不完整');
        }
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->guard_name = 'backend';
        if($role->save()){
            $permissions = Permission::whereIn('id',$request->permissions)->get();
            $role->syncPermissions($permissions);
            return $this->success();
        }
        return $this->fail('保存失败');
    }
}