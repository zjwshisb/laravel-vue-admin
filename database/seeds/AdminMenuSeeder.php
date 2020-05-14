<?php

use \Illuminate\Database\Seeder;
use App\Models\AdminMenu;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
class AdminMenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            [
                'name' => '系统设置',
                'children' => [
                    [
                        'name' => '管理员',
                        'permissions' => [
                            'admins.index'
                        ],
                        'children' => [
                            [
                                'name' => '新增',
                                'permissions' => [
                                    'admins.store'
                                ]
                            ],
                            [
                                'name' => '编辑',
                                'permissions' => [
                                    'admins.show',
                                    'admins.update'
                                ]
                            ],
                        ]
                    ],
                ]
            ]
        ];
        $guard = 'backend';
        $allPermission = [];
        AdminMenu::query()->delete();
        \Illuminate\Support\Facades\DB::table('admin_menu_permissions')->delete();
        $func = function ($m, $parent = null) use (&$allPermission, &$func, $guard) {
            $menu = new AdminMenu();
            $menu->name = $m['name'];
            if (!is_null($parent)) {
                $menu->parent_id = $parent->id;
            }
            $menu->save();
            foreach (Arr::get($m, 'permissions', []) as $permission) {
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
    }
}
