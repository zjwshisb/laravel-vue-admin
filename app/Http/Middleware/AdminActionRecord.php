<?php
namespace App\Http\Middleware;
use App\Models\AdminActionLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Class Permission
 * @package App\Http\Middleware
 */
class AdminActionRecord {
    public function handle(Request $request, Closure $next)
    {
        $res = $next($request);
        if(strtoupper($request->getMethod()) !== 'OPTIONS') {
            AdminActionLog::query()->create([
                'admin_id' => \Auth::id(),
                'method'=> $request->getMethod(),
                'action'=> Route::currentRouteAction(),
                'params'=> $request->all(),
                'route_params' => Route::current()->parameters,
                'ip'=> $request->getClientIp(),
                'created_at'=> now()->toDateTimeString()
            ]);
        }
        return $res;
    }
}
