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

    public function method($val) {
        return $this->where('method', $val);
    }
}
