<?php

namespace App\Models;


use Spatie\Permission\Models\Role as Origin;

/**
 * Class Roles
 * @package App\Models
 */
class Role extends Origin
{

    protected $fillable  = [
        'name','description','guard_name','school_id','kitchen_id'
    ];

    public function scopeBackend($query){
        return $query->where("guard_name",'backend');
    }
}
