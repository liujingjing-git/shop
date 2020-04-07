<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
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

        //检测是否登录
        if(res==2){
            alert("请先去登录")
            location.href="{{url('login')}}"
        }

        return $next($request);
    }
}
