<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'description'=> $this->description,
            'created_at'=> $this->created_at->toDateTimeString(),
            'updated_at'=> $this->updated_at->toDateTimeString()
        ];
    }
}
