<?php
namespace App\Http\Controllers\Backend;


use App\Http\Requests\Backend\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends BaseController{

    public function index(Request $request){
        $admins = Admin::filter($request->all())->paginate($request->size);
        return AdminResource::collection($admins);
    }

    public function show($id) {
        $admin = Admin::query()->findOrFail($id);
        return [
          'username'=> $admin->username,
          'roles'=> $admin->roles->pluck('id'),
            'is_forbidden'=> $admin->is_forbidden
        ];
    }

    public function store(AdminRequest $request) {
        $admin = Admin::query()->create($request->all());
        $admin->roles()->sync($request->roles);
        return $this->success(new AdminResource($admin));
    }

    public function update(AdminRequest $request,$id) {
        $admin = Admin::query()->findOrFail($id);
        $admin->is_forbidden = $request->is_forbidden;
        $admin->roles()->sync($request->roles);
        $admin->save();
        return $this->success(new AdminResource($admin));

    }

    public function password(Request $request, $id) {
        $admin = Admin::query()->findOrFail($id);
        $this->validate($request, [
            'password'=> 'required'
        ],[
            'password'=> '密码'
        ]);
        $admin->password = $request->password;
        $admin->save();
        return $this->success();
    }

    public function destroy(){

    }

    public function options(Request $request) {
        return Role::query()->select(['id','name'])->get();
    }

}
