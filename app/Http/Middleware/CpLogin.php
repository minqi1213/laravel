<?php

namespace App\Http\Middleware;

use Closure;

class CpLogin
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
        if(!session('role') || !session('userid')){
            return redirect('cp/login');
        } else if (session('role')!='cp'){
            return redirect('cp/login');
        }
        return $next($request);
    }
}
