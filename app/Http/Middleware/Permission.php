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
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if($user && $user->is_super != 1) {
            $route = Route::currentRouteName();
            if ($user->can($route)) {
                return $next($request);
            } else {
               throw new AuthorizationException();
            }
        }
        return $next($request);
    }
}
