<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SessionLimiter
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
        if(Auth::check() && Auth::user()->type_user === "abonné" && Auth::user()->current_abonnement){
            // count loggedin devices
            $count = DB::table('sessions')
            ->where('user_id', Auth::user()->id)
            ->count();
            // check if limit
            if(Auth::user()->current_abonnement->session_limit < $count){
                // redirect to device manager view
                return redirect()->route('device_manager');
            }
        }
        return $next($request);
    }
}
