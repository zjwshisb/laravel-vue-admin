<?php

namespace App\Http\Controllers\Backend;

use App\Models\Roles;
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
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $roles = Role::when($name = $request->name,function($query) use ($name){
            $query->where('name',$name);
        })->orderBy('created_at','desc')->with('permissions:name,id,role_id')
            ->paginate($request->size);
        $permissions = Permission::all();
        $menu = Roles::getPermissions($permissions);
        return $this->success([
            'roles' => $roles,
            'permissions' => $menu
        ]);
    }

    /**
     * @param Request $request
     * @return array
     */
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

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request,$id) {
        $role = Role::findOrFail($id);

        $role->name = $request->name;
        $role->description = $request->description;
        if($role->save()){
            $permissions = Permission::whereIn('id',$request->permissions)->get();
            $role->syncPermissions($permissions);
            return $this->success();
        }
        return $this->fail('保存失败');
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id) {
        if(Role::destroy($id)) {
            return $this->success();
        }
        return $this->fail('删除失败');
    }
}
