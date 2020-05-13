<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource{

    public function toArray($request)
    {
        return [
          'id'=> $this->id,
          'username'=> $this->username,
            'created_at'=> (string) $this->created_at
        ];
    }
}
