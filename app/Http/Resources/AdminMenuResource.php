<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminMenuResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'children'=> AdminMenuResource::collection($this->children)
        ];
    }
}
