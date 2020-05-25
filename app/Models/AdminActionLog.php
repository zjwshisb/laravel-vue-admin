<?php
namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class AdminActionLog extends Model{

    use Filterable;

    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'method',
        'action',
        'params',
        'route_params',
        'ip',
        'created_at',
        'name'
    ];

    protected $casts = [
        'params'=> 'array',
        'route_params'=> 'array'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
