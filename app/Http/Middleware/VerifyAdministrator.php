<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAdministrator
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
        if(!\Auth::user()->isAdmin()){
            return redirect('/dashboard')->withError('Access Denied');
        }
        return $next($request);
    }
}
