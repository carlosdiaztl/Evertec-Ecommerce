<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->secure() && env('APP_ENV') === 'production') {
            // Redirige todas las solicitudes HTTP a HTTPS
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
