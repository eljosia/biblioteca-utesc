<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth_key = env('ENCRYPT_PASS');
        if (base64_decode($request->key) !== $auth_key) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
