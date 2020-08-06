<?php
namespace App\Http\Middleware;
use App\Models\AdminActionLog;
use App\Models\AdminMenu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Class Permission
 * @package App\Http\Middleware
 */
class AdminActionRecord {

    protected $ignores = [
      'GET', 'OPTIONS'
    ];

    public function handle(Request $request, Closure $next)
    {
        $res = $next($request);
        $method = $request->getMethod();
        if(!in_array($method, $this->ignores)) {
            $action = Route::current()->getAction()['controller'] ?? '';
            $menu = AdminMenu::query()->whereHas('permissions',function ($query) use ($action){
               $query->where('name', $action)
                   ->where('guard_name', 'admin');
            })->first();
            if($menu) {
                $breadcrumb = $menu->getBreadcrumb();
            }
            AdminActionLog::query()->create([
                'admin_id' => \Auth::id(),
                'method'=> $request->getMethod(),
                'action'=> Route::currentRouteAction(),
                'params'=> $request->all(),
                'route_params' => Route::current()->parameters,
                'ip'=> $request->getClientIp(),
                'created_at'=> now()->toDateTimeString(),
                'name'=> $breadcrumb ?? ''
            ]);
        }
        return $res;
    }
}
