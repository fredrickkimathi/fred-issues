<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  int  $role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        if (Auth::check() && Auth::user()->role_id == $role) {
            return $next($request);
        }

        // Optionally, you can redirect to a specific page or show an error
        return redirect('/dashboard')->with('error', 'You do not have permission to access this page.');
    }
}
