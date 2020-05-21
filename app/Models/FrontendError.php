<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendError extends Model{

    public $timestamps = false;

    protected $fillable = [
        'created_at',
        'message',
        'name',
        'stack',
        'info',
        'admin_id'
    ];
}
