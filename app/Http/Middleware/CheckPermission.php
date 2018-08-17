<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
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

        if ( !auth()->check() ){
            return redirect()->route('login');
        }
 
        $tipo = auth()->user()->tipo;
    
        if ( $tipo != 1 ){
            return redirect('home');
        }

        return $next($request);
    }
}
