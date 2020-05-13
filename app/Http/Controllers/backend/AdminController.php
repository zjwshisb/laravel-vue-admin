<?php
namespace App\Http\Controllers\Backend;


use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends BaseController{

    public function index(Request $request){
        $admins = Admin::filter($request->all())->paginate($request->size);
        return AdminResource::collection($admins);
    }

    public function store() {

    }

    public function update() {

    }

    public function destroy(){

    }
}
