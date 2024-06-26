<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
    
        if ($request->user()->role !== $role) {
            if ($request->user()->role == 'admin') {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('frontend.index');
            }
        }
        return $next($request);
    }
}
