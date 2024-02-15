<?php

namespace App\Http\Middleware;

use App\Models\ADM;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAdminGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //funçao para barrar usuarios sem instancia de adm
        if(!Auth::user()instanceof ADM){
            return response()->json([
                'status'=> false,
                'message'=>'não é uma instancia de adm'
            ]);
        }

        return $next($request);
    }
}
