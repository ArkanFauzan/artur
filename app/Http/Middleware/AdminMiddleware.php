<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        // get the current path
        $path = $request->path();
        strpos($path,'member') === 0 ? $route='member' : $route = 'admin' ;

        // get the role of current authenthicated user
        $role = auth()->user()->role;

        if($route===$role){
            return $next($request);
        }
        return redirect("/".$role);
    }
}
