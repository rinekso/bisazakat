<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        return $next($request);
    }
}
