<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        $roles  = $this->getRequiredRoleForRoute($request->route());
        if($request->user()->hasRole($roles)|| !$roles)
        {
            return $next($request);
        }
        return redirect('/noPermission');
    }
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles']: null;
    }
}
