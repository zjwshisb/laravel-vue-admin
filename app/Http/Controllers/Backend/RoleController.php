<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreRole;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

/**
 * Class RoleController
 * @package App\Http\Controllers\Backend
 */
class RoleController extends BackendController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $roles = Role::when($name = $request->name,function($query) use ($name){
            $query->where('name',$name);
        })->orderBy('created_at','desc')->with('permissions')->paginate($request->size);
        return RoleResource::collection($roles);
    }

    /**
     * @param StoreRole $request
     * @return RoleResource
     */
    public function store(StoreRole $request){
        $role = Role::create(array_merge($request->all(),[
            'guard_name'=>'backend'
        ]));
        $permissions = Permission::whereIn('id',$request->permissions)->get();
        $role->syncPermissions($permissions);
        return new RoleResource($role);
    }

    /**
     * @param Role $role
     * @return RoleResource
     */
    public function update(Role $role) {
        $role->name = \request()->name;
        $role->description = \request()->description;
        $permissions = Permission::whereIn('id',\request()->permissions)->get();
        $role->syncPermissions($permissions);
        $role->save();
        return new RoleResource($role);
    }

    /**
     * @param $id
     * @return RoleResource
     */
    public function destroy($role) {
        $role->delete();
        return new RoleResource($role);
    }
}
