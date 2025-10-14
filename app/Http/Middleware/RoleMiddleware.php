<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();
    
        if (!$user || $user->role !== $role) {
            return response('Unauthorized.', 403);
        }
    
        return $next($request);
    }
}
//middleware untuk mengecek role user apakah sesuai dengan yang diijinkan atau tidak