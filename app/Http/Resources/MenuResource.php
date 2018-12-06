<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MenuResource extends Resource{

    public function toArray($request)
    {
        return $this->getPermissions();
    }

    /**
     * @param $permissions
     * @return array
     * 根据菜单进行数组重组
     */
    public  function getPermissions(){
        $menu = [];
        foreach ($this->resource as $key => $val) {
            $menu[$val->menu] = [
                'id' => $val->id,
                'name' => $val->menu,
                'children' => self::getGroup($val->menu)
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
    public  function getGroup($menu){
        $group = [];
        foreach ($this->resource as $key => $val){
            if ($val->menu === $menu){
                $group[$val->group] = [
                    'id' => $val->id,
                    'name' => $val->group,
                    'children' => self::getDescription($val->group)
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
    public  function getDescription($group){
        $data = [];
        foreach ($this->resource as $key => $val){
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
