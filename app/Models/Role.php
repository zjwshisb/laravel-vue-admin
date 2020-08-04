<?php
namespace App\Models;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role as RoleAble;

class Role extends RoleAble {

    protected $fillable = [
      'name','description','guard_name'
    ];

    public function menus() {
        return $this->belongsToMany(AdminMenu::class, 'role_admin_menus', 'role_id', 'menu_id');
    }

    public function syncMenusToPermission() {
        $this->refresh();
        $permissions= new Collection();
        foreach($this->menus as $menu) {
            $permissions = $permissions->concat($menu->permissions);
        }
        $this->syncPermissions($permissions->pluck('id')->toArray());
    }
}
