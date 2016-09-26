<?php

namespace App\Http\Middleware;

use Closure;

class EngineerLogin
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
            return redirect('engineer/login');
        } else if (session('role')!='engineer'){
            return redirect('engineer/login');
        }
        return $next($request);
    }
}
