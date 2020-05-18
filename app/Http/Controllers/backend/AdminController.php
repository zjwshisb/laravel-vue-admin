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

    public function store(AdminRequest $request) {
        $admin = Admin::query()->create($request->all());
    }

    public function update() {

    }

    public function destroy(){

    }

    public function options(Request $request) {
        return Role::query()->select(['id','name'])->get();
    }

}
