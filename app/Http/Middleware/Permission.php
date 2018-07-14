<?php
namespace App\Http\Middleware;
use App\Exceptions\ForbiddenException;
use Closure;
use Illuminate\Support\Facades\Route;

class Permission {

    protected $except = [
      'users.index'
    ];

    /**
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     * @throws ForbiddenException
     */
    public function handle($request, Closure $next){
        $user = $request->user();
        $permission  = Route::currentRouteName();
        if($user->is_super || in_array($permission,$this->except) || $user->hasPermissionTo($permission)){
            return $next($request);
        }
        throw new ForbiddenException();
    }
}