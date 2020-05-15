<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AdminMenu extends Model{

    public function permissions() {
        return $this->belongsToMany(Permission::class,
            'admin_menu_permissions','menu_id','permission_id');
    }

    public function children() {
        return $this->hasMany(self::class, 'parent_id')->select('parent_id','id','name','has_permission');
    }

}
