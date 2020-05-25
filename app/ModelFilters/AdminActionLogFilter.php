<?php

namespace App\ModelFilters;

use App\Models\Admin;
use EloquentFilter\ModelFilter;

class AdminActionLogFilter extends ModelFilter
{
    public $relations = [];

    public function admin($val) {
        $admin = Admin::query()->where('username', 'like', '%'.$val."%")->get();
        return $this->whereIn('admin_id', $admin->pluck('id'));
    }

    public function name($val) {
        return $this->where('name','like','%'.$val.'%');
    }
}
