<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'backend';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','api_token','expire_time'
    ];

    /**
     * @param $val
     */
    public function setPasswordAttribute($val) {
        $this->attributes['password'] = Hash::make($val);
    }

    /**
     * @return bool
     */
    public function getSuperAdminAttribute(){
        return !!$this->is_super;
    }

}
