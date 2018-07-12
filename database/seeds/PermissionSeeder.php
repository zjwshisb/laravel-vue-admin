<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class PermissionSeeder
 */
class PermissionSeeder extends Seeder{

    public function run(){
        $tableNames = config('permission.table_names');
        $date = date('Y-m-d H:i:s');
        DB::table($tableNames['permissions'])->insert([
            [
                'name'=>'tokens.index',
                'description' => '角色列表',
                'group'=>'权限组',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'tokens.store',
                'description' => '新增角色',
                'group'=>'权限组',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'tokens.update',
                'description'=>'编辑角色',
                'group'=>'权限组',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'tokens.destroy',
                'description'=>'删除角色',
                'group'=>'权限组',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'admin.index',
                'description' => '管理员列表',
                'group'=>'管理员',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'admin.store',
                'description' => '新增管理员',
                'group'=>'管理员',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'admin.update',
                'description'=>'编辑管理员',
                'group'=>'管理员',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
            [
                'name'=>'admin.destroy',
                'description'=>'删除管理员',
                'group'=>'管理员',
                'guard_name'=>'backend',
                'created_at'=>$date,
                'updated_at'=>$date
            ],
        ]);
    }
}