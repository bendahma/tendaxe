<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminpanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && (Auth::user()->type_user === "publisher" || Auth::user()->type_user === "Super admin" || Auth::user()->type_user === "admin")){
            return $next($request);
        }
        
        return abort(403);
    }
}
