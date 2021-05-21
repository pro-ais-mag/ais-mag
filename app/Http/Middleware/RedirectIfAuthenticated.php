<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $position = Auth::user()->position;
            switch($position){
                case 'Consumerables':
                    return '/user';
                    break;
                case 'Line Manager':
                    return '/user';
                    break;
                case 'Reception':
                    return '/user';
                    break;  
                case 'Estimator':
                    return '/user';
                    break;
                case 'Administrator':
                    return '/administrator';
                    break;              
            }
        }

        return $next($request);
    }
}
