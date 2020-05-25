<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminActionLogResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'admin_name'=> $this->admin->username ?? '',
            'ip'=> $this->ip,
            'name'=> $this->name,
            'created_at' => $this->created_at
        ];
    }
}
