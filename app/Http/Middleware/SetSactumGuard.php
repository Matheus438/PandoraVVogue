<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
class SetSactumGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //se a rota for /admin vai redirecionar para esse guard
                if(Str::startsWith($request->getRequestUri(), '/api/adm')){
                    config(['sanctun.guard'=> 'Adm']);
                } else {
                    return 'sem guard';
                }
        
                return $next($request);
            }
}
