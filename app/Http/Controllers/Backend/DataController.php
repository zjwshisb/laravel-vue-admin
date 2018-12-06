<?php
namespace  App\Http\Controllers\Backend;
use App\Http\Resources\MenuResource;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\Permission;

/**
 * Class DataController
 * @package App\Http\Controllers\Backend
 * @author zjw
 */
class DataController extends AdminController{

    public function index(Request $request)
    {
        $sources = $request->get('sources',[]);
        $data = [];
        foreach ($sources as $v) {
            if(method_exists($this,$v)){
                $data[$v] = call_user_func([$this,$v],$request);
            }
        }
        return $data;
    }

    public function menus(Request $request){
        return new MenuResource(Permission::backend()->get());
    }

    public function roles(Request $request){
        return RoleResource::collection(Role::backend()->get());
    }

}
