<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class RoleResource
 * @package App\Http\Resources
 * @author zjw
 */
class RoleResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'permissions' => PermissionResource::collection($this->permissions),
            'created_at' => $this->created_at->format("Y-m-d H:i:s"),
            'description' => $this->description
        ];
    }
}
