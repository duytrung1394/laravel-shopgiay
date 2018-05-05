<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AdminLoginMiddleware
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
        if(Auth::guard('admins')->check())
        {
            if(Auth::guard('admins')->user()->level == 2){
                return $next($request);
            }else{
                return redirect('admin/dang-nhap');
            }
        }else{
            return redirect('admin/dang-nhap');
        }
    }
}
