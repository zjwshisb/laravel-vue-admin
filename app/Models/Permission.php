<?php
namespace App\Models;

use Spatie\Permission\Models\Permission as Origin;

class Permission extends Origin{

    public function scopeBackend($query){
        return $query->where("guard_name",'backend');
    }
}
