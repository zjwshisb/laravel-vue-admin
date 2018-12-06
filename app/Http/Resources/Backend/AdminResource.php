<?php

namespace App\Http\Resources\Backend;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class AdminResource
 * @package App\Http\Resources\Backend
 * @author zjw
 */
class AdminResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at->format("Y-m-d H:i:s"),
            'last_login_at' => $this->last_login_at,
            'roles' => RoleResource::collection($this->roles),
            'status' => $this->status,
            'username' => $this->username
        ];
    }
}
