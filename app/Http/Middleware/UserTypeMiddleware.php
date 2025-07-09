<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserTypeMiddleware
{
    public function handle(Request $request, Closure $next, string $type): Response
    {
        $guard = $type === 'admin' ? 'admin' : 'web';
        $user = Auth::guard($guard)->user();

        if (!$user) {
            return redirect()->route('admin.login')->withErrors(['message' => 'Silakan login terlebih dahulu.']);
        }

        if (($type === 'admin' && !$user instanceof \App\Models\Admin) ||
            ($type === 'user' && !$user instanceof \App\Models\User)
        ) {
            return abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
