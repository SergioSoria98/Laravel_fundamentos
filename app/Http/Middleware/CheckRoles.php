<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models;
use Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle( $request, Closure $next)
    {
        $roles = array_slice(func_get_args(), 2);
            
            if (auth()->user()->hasRoles($roles))
            {
                return $next($request);
            }
        
        return redirect('/');
    }
}
