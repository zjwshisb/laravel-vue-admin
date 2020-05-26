<?php
namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravolt\Avatar\Avatar;
use Laravolt\Avatar\Facade;
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


    public function getAvatarAttribute() {
        if(!$this->attributes['avatar']) {
            $avatarDir = \Storage::disk('public')->path('avatar');
            if(!is_dir($avatarDir)) {
                mkdir($avatarDir);
            }
            $path = 'avatar/'. $this->id.".png";
            $fullPath = \Storage::disk('public')->path($path);
            Facade::create($this->username)->save($fullPath);
            $this->avatar = $path;
            $this->save();
        }
        return \Storage::disk('public')->url($this->attributes['avatar']);
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
