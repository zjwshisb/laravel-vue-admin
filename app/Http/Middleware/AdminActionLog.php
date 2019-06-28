<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class AdminActionLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (strtoupper($request->method()) !== 'OPTIONS'){
            \App\Models\AdminActionLog::create([
                'route' => Route::currentRouteAction(),
                'admin_id'=> \Auth::id(),
                'params'=> $request->all(),
                'user_agent' => $request->userAgent(),
                'action_ip'=> $request->ip(),
                'method'=> $request->method()
            ]);
        }
        return $next($request);
    }
}
