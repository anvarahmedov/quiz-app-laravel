<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCspHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Set Content-Security-Policy header without new lines
        $response->headers->set('Content-Security-Policy',
            "default-src 'self'; script-src 'self' https://www.google.com https://www.gstatic.com; frame-src https://www.google.com; object-src 'none';");

        return $response;
    }
}
