<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\RoleRequest;
use App\Http\Resources\AdminMenuResource;
use App\Http\Resources\RoleResource;
use App\Models\AdminMenu;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController{

    public function show($id) {
        $role = Role::query()->findOrFail($id);
        return [
            'id'=> $role->id,
            'name'=> $role->name,
            'description'=> $role->description,
            'menus'=> $role->menus->pluck('id')
        ];
    }

    public function index(Request $request) {
        $roles = Role::query()->withCount('users')->paginate($request->size);
        return RoleResource::collection($roles);
    }

    public function store(RoleRequest $request) {
        return DB::transaction(function() use ($request) {
            $role = new Role();
            $role->fill(array_merge($request->all(), ['guard_name'=>'admin']));
            $role->save();
            $role->menus()->sync($request->menus);
            $role->syncMenusToPermission();
            return $this->success(new RoleResource($role));
        });
    }

    public function update(Request $request, $id) {
        return DB::transaction(function() use ($request, $id) {
            $role = Role::query()->findOrFail($id);
            $role->fill($request->all());
            $role->save();
            $role->menus()->sync($request->menus);
            $role->syncMenusToPermission();
            return $this->success(new RoleResource($role));
        });
    }

    public function destroy($id) {
        return DB::transaction(function () use ($id){
            $role = Role::query()->findOrFail($id);
            $role->menus()->detach();
            $role->delete();
            return $this->success();
        });

    }

    public function options() {
        $menus = AdminMenu::query()->whereNull('parent_id')
            ->select(['id','name','parent_id'])
            ->with('children.children.children')->get();
        return AdminMenuResource::collection($menus);
    }
}
