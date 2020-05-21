<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminActionLogResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'admin_name'=> $this->admin->username ?? '',
            'params'=> $this->params,
            'route_params'=> $this->route_params,
            'method'=> $this->method,
            'action'=> $this->action,
            'ip'=> $this->ip,
            'created_at' => $this->created_at
        ];
    }
}
