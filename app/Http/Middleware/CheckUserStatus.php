<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user() && auth()->user()->status === 'inactive') {
            auth()->logout();
            return redirect('/login')->withErrors('Tu cuenta está inactiva.');
        }

        return $next($request);
    }
}
