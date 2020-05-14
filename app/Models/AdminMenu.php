<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AdminMenu extends Model{

    public function permissions() {
        return $this->belongsToMany(Permission::class,
            'admin_menu_permissions','menu_id','permission_id');
    }

}
