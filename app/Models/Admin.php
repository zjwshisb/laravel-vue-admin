<?php
namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Session\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Avatar\Avatar;
use Laravolt\Avatar\Facade;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable{

    use Filterable;
    use HasRoles;


    public static function boot()
    {
        parent::boot();
    }

    protected $fillable = [
      'username', 'password', 'is_forbidden'
    ];

    public function setPasswordAttribute($val) {
        $this->attributes['password'] = Hash::make($val);
    }

    public function getIsForbiddenAttribute($val) {
        return  !!$this->attributes['is_forbidden'];
   }

    public function setIsForbiddenAttribute($val) {
        $this->attributes['is_forbidden'] = $val ? 1 : 0;
    }

    public function getAvatarAttribute() {
        return  $this->attributes['avatar'] ? \Storage::disk('public')->url($this->attributes['avatar']) : '';
    }

    public function getMenusAttribute() {
        if($this->is_super == 1) {
            $menus = AdminMenu::query()->get();
        } else {
            $menus = new Collection();
            foreach ($this->roles as $role) {
                $menus = $menus->concat($role->menus);
            }
        }
        return $menus;
    }

}
