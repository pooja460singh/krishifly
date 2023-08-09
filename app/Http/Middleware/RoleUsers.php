<?php

namespace App\Http\Middleware;

use Closure;

class RoleUsers
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
        if(auth()->user()->role_id == 1 and auth()->user()->status == 1){
            return $next($request);
        }else{
             return redirect()->back()->with(['message' =>"You don't have admin access."]);
         }
    }
}
