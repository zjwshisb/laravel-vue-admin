<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreAdmin;
use App\Http\Resources\Backend\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
class AdminController extends BackendController{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $admins = Admin::when($username = $request->username,function($query) use ($username){
            $query->where('username','like',$username."%");
        })->orderBy('created_at','desc')->with('roles')->paginate($request->size);
        return AdminResource::collection($admins);
    }

    /**
     * @param StoreAdmin $request
     * @return AdminResource
     */
    public function store(StoreAdmin $request){
        $admin = Admin::create($request->all());
        $roles = Role::whereIn('id',$request->roles)->get();
        $admin->syncRoles($roles);
        return new AdminResource($admin);
    }

    /**
     * @param Admin $admin
     * @return AdminResource
     */
    public function update(Admin $admin) {
        $admin->status = \request()->status;
        $admin->save();
        $roles = Role::whereIn('id',\request()->roles)->get();
        $admin->syncRoles($roles);
        return new AdminResource($admin);
    }

}
