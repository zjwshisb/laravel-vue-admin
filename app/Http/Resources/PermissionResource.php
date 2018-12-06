<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PermissionResource extends Resource{
    public function toArray($request)
    {
        return [
            'name'=> $this->name,
            'id'=> $this->id,
        ];
    }
}
