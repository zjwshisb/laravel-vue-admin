<?php
namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable{

    public function setPasswordAttribute($val) {
        $this->attributes['password'] = Hash::make($val);
    }
}
