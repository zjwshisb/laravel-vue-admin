<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FrontendErrorResource extends JsonResource{

    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'message'=> $this->message,
            'name'=> $this->name,
            'stack'=> $this->stack,
            'info'=> $this->info,
            'created_at'=> $this->created_at
        ];
    }
}
