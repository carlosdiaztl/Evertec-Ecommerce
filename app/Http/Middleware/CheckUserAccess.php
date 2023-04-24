<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if ($user && $user != $request->route()->parameter('user')) {
            $content = '<div style="background-color: #F44336; color: white; padding: 10px;">
            <h1>403 THIS ACTION IS UNAUTHORIZED.
                </h1> </div>';
            return response($content, Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
