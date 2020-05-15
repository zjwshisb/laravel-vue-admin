<?php
namespace App\Models;
use Spatie\Permission\Models\Role as RoleAble;

class Role extends RoleAble {

    public function menus() {
        return $this->belongsToMany(AdminMenu::class, 'role_admin_menus', 'role_id', 'menu_id');
    }
}
