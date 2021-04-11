<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkLogin
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
        $requestLogin = substr($request->path(), stripos($request->path(), '/')+1);
        if(Auth::user()->login === $requestLogin || Auth::user()->login === ucfirst($requestLogin)){
            return response()->json([]);
        }

        return $next($request);
    }
}
