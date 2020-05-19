<?php
namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable{

    use Filterable;
    use HasRoles;

    protected $fillable = [
      'username', 'password'
    ];

    public function setPasswordAttribute($val) {
        $this->attributes['password'] = Hash::make($val);
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
