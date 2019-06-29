<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder
{

    public function run()
    {
        $tableNames = config('permission.table_names');
        $date = date('Y-m-d H:i:s');
        $permissions = [
            '系统管理' => [
                '权限组' => [
                    '角色列表' => 'roles.index',
                    '新增角色' => 'roles.store',
                    '编辑角色' => 'roles.update',
                    '修改密码' => 'roles.destroy'
                ],
                '管理员' => [
                    '管理员列表' => 'admins.index',
                    '新增管理员' => 'admins.store',
                    '编辑管理员' => 'admins.update',
                    '重置密码' => 'admins.destroy'
                ],
                '操作日志'=> [
                    '日志列表'=>'admin-logs.index'
                ]
            ]
        ];
        $permissionNames = [];
        foreach ($permissions as $key => $permission) {
            foreach ($permission as $k => $item) {
                foreach ($item as $i => $v) {
                    if (DB::table($tableNames['permissions'])->whereName($v)->doesntExist()) {
                        DB::table($tableNames['permissions'])->insert([
                            'name' => $v,
                            'menu' => $key,
                            'group' => $k,
                            'created_at' => $date,
                            'updated_at' => $date,
                            'description' => $i,
                            'guard_name' => 'backend'
                        ]);
                    } else {
                        DB::table($tableNames['permissions'])->whereName($v)->update([
                            'name' => $v,
                            'menu' => $key,
                            'group' => $k,
                            'created_at' => $date,
                            'updated_at' => $date,
                            'description' => $i,
                            'guard_name' => 'backend'
                        ]);
                    }
                    array_push($permissionNames, $v);
                }
            }
        }
        if (app()->environment() === 'production') {
            $data = DB::table($tableNames['permissions'])->get();
            foreach ($data as $datum) {
                if (!in_array($datum->name, $permissionNames)) {
                    DB::table($tableNames['permissions'])->whereName($datum->name)->delete();
                }
            }
        }
    }
}
