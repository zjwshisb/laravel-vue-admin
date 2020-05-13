<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AdminFilter extends ModelFilter
{
    public $relations = [];

    public function username($val) {
        return $this->where('username',$val);
    }
}
