<?php
namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable{

    use Filterable;

    public function setPasswordAttribute($val) {
        $this->attributes['password'] = Hash::make($val);
    }
}
