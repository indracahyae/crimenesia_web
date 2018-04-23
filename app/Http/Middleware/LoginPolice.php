<?php

namespace App\Http\Middleware;

use Closure;

class LoginPolice
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
        //check login
        if (!$request->session()->has('loginPolice')) {
            // $request->session()->get('loginAdmin') === null
            return redirect('vLoginPolice');
        }
        return $next($request);
    }
}
