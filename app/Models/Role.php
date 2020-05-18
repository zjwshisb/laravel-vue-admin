<?php
namespace App\Models;
use Spatie\Permission\Models\Role as RoleAble;

class Role extends RoleAble {

    protected $fillable = [
      'name','description','guard_name'
    ];

    public function menus() {
        return $this->belongsToMany(AdminMenu::class, 'role_admin_menus', 'role_id', 'menu_id');
    }
}
