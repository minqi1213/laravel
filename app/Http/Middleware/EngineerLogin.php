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
            return redirect('admin/login');
        } else if (session('role'!='admin')){
            return redirect('admin/login');
        }
        return $next($request);
    }
}
