<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Route;

/**
 * Class Permission
 * @package App\Http\Middleware
 */
class Permission {
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if($user && $user->is_super != 1) {
            $action = Route::current()->getAction()['controller'] ?? '';
            if (!$action || $user->can($action)) {
                return $next($request);
            }
        }
        throw new AuthorizationException();
    }
}
