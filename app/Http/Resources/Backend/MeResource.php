<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\Resource;
use Spatie\Permission\Models\Permission;

class MeResource extends Resource
{
    public function toArray($request)
    {
        $func = function($v){
            return $v->name;
        };
        return [
            'user' => [
                'id'=> $this->id,
                'username'=>$this->username
            ],
            'permissions' => $this->super_admin ?
                Permission::all()->map($func) :
                $this->getPermissionsViaRoles()->map($func)
        ];
    }
}
