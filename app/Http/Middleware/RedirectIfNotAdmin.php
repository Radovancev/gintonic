<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAdmin
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
        if(session()->has('user')){

            if(session()->get('user')[0]->role->role_name === 'admin') 
                return $next($request);
            
        }
        return redirect('/');
    }
}
