<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AdminMenu extends Model{


    protected $appends = ['checkable'];

    public function getCheckAbleAttribute() {
        return !!$this->has_permission;
    }

    public function getBreadcrumb(){
        $title= [];
        $_this = $this;
        $title[] = $_this->name;
        while($_this->parent) {
            $_this = $_this->parent;
            $title[] = $_this->name;
        };
        return implode('>', array_reverse($title));
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class,
            'admin_menu_permissions','menu_id','permission_id');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id')->select('parent_id','id','name','has_permission');
    }

    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
    }

}
