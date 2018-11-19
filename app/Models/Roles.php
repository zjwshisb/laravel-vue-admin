<?php

namespace App\Models;


use Spatie\Permission\Models\Role;

/**
 * Class Roles
 * @package App\Models
 */
class Roles extends Role
{
    /**
     * @param $permissions
     * @return array
     * 根据菜单进行数组重组
     */
    public static function getPermissions($permissions){
        $menu = [];
        foreach ($permissions as $key => $val) {
            $menu[$val->menu] = [
                'id' => $val->id,
                'name' => $val->menu,
                'children' => Roles::getGroup($permissions,$val->menu)
            ];
        }
        return array_values($menu);
    }
    /**
     * @param $permission
     * @param $menu
     * @return array
     * 根据menu分组
     */
    public static function getGroup($permission,$menu){
        $group = [];
        foreach ($permission as $key => $val){
            if ($val->menu === $menu){
                $group[$val->group] = [
                    'id' => $val->id,
                    'name' => $val->group,
                    'children' => self::getDescription($permission,$val->group)
                ];
            }
        }
        return array_values($group);
    }

    /**
     * @param $permission
     * @param $group
     * @return array
     * 根据group分组
     */
    public static function getDescription($permission,$group){
        $data = [];
        foreach ($permission as $key => $val){
            if ($val->group === $group){
                $data[$val->description] = [
                    'id' => $val->id,
                    'name' => $val->description
                ];
            }
        }
        return array_values($data);
    }
}
