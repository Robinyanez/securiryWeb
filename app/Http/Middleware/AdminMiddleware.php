<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
        if (auth()->user() && auth()->user()->role==='Admin'){
            return $next($request);
        }else{
            return redirect('/')->with('error','Usted no tiene permisos de adminitrador para entrar.');
        }
    }
}
