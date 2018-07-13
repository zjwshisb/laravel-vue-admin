<?php
namespace App\Http\Controllers\Backend;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
class AdminController extends BackendController{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $admin = Admin::when($username = $request->username,function($query) use ($username){
            $query->where('username','like',$username."%");
        })->orderBy('created_at','desc')->with('roles')->paginate($request->size);
        return $this->success([
            'admins' => $admin,
            'roles'=> Role::all()
        ]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'username'=>'required',
            'password'=>'required'
        ]);
        if($validator->fails()){
           throw new ValidationException($validator);
        }
        $admin = Admin::firstOrNew([['username',$request->username]]);
        if($admin->exists) {
            return $this->fail('已存在相同的账号名');
        }
        $admin->fill($request->all());
        if($admin->save()){
            $roles = Role::whereIn('id',$request->roles)->get();
            $admin->syncRoles($roles);
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
        $admin = Admin::findOrFail($id);
        $admin->status = $request->status;
        if($admin->save()){
            $roles = Role::whereIn('id',$request->roles)->get();
            $admin->syncRoles($roles);
            return $this->success();
        }
        return $this->fail('保存失败');
    }

}