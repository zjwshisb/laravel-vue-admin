<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminActionLog
 *
 * @property int $id
 * @property string $route 路由
 * @property int $admin_id adminId
 * @property array $params 请求参数
 * @property string $user_agent userAgent
 * * @property string $method 请求方法
 * @property string $action_ip 操作ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereActionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereUserAgent($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereActionIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AdminActionLog whereMethod($value)
 */
class AdminActionLog extends Model
{
    public $casts = [
      'params'=> 'array'
    ];

    public $fillable = [
        'route','admin_id','params','user_agent','action_ip','method'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
