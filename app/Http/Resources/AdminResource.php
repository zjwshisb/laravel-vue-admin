<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource{

    public function toArray($request)
    {
        return [
          'id'=> $this->id,
          'username'=> $this->username,
            'roles'=> $this->roles->pluck('name')->implode(','),
            'created_at'=> $this->created_at->toDateTimeString(),
            'last_login_at'=> $this->last_login_at
        ];
    }
}
