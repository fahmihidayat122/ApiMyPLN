<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $user = $request->user();

        if ($type === 'admin' && !$user instanceof \App\Models\Admin) {
            return response()->json(['message' => 'Unauthorized. Admin access required.'], 403);
        }

        if ($type === 'user' && !$user instanceof \App\Models\User) {
            return response()->json(['message' => 'Unauthorized. User access required.'], 403);
        }

        return $next($request);
    }
}
