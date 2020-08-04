<?php

use \Illuminate\Database\Seeder;
use App\Models\AdminMenu;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class AdminMenuSeeder extends Seeder
{
    public function run()
    {
        $menus = config('adminmenus');
        $guard = 'admin';
        $allPermission = [];
        AdminMenu::query()->delete();
        DB::table('admin_menu_permissions')->delete();
        $func = function ($m, $parent = null) use (&$allPermission, &$func, $guard) {
            $menu = new AdminMenu();
            $mPermission = Arr::get($m, 'permissions', []);
            $menu->name = $m['name'];
            $menu->id = $m['id'];
            if (!is_null($parent)) {
                $menu->parent_id = $parent->id;
            }
            if(sizeof($mPermission) > 0) {
                $menu->has_permission = 1;
            }
            $menu->save();
            foreach ($mPermission as $permission) {
                $allPermission[] = $permission;
                $per = Permission::query()
                    ->where('guard_name', $guard)
                    ->where('name', $permission)->first();
                if (!$per) {
                    $per = Permission::create([
                        'name' => $permission,
                        'guard_name' => $guard
                    ]);
                }
                $menu->permissions()->attach($per->id);
            }
            foreach (Arr::get($m, 'children', []) as $child) {
                $func($child, $menu);
            }
        };
        foreach ($menus as $menu) {
            $func($menu);
        }
        Permission::query()->whereNotIn('name', $allPermission)->delete();
        $roles = \App\Models\Role::query()->get();
        foreach ($roles as $role) {
           $role->syncMenusToPermission();
        }
    }
}
