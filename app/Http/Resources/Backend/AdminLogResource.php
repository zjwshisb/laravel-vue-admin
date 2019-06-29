<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Resources\Json\Resource;

/**
 * Class AdminResource
 * @package App\Http\Resources\Backend
 * @author zjw
 */
class AdminLogResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'route' => $this->route,
            'params'=> $this->params,
            'action_ip'=> $this->action_ip,
            'admin_name'=> $this->admin->username,
            'created_at'=> $this->created_at->toDateTimeString() ?? ''
        ];
    }
}
