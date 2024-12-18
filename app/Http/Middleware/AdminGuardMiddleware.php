<?php

namespace App\Http\Middleware;

use App\Helpers\Constans;
use App\Helpers\ResponseFormatter;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role = null)
    {
        // Check if the user is authenticated and is an admin
        $user = JWTAuth::parseToken()->authenticate();
        $is_admin = in_array($role, $user->roles->pluck('name')->toArray());
        if (!isset($user) && !$is_admin) {
            return ResponseFormatter::error("your account dont have access, contact admin for other information", 403, null, 'forbidden');
        }

        // Continue to the next middleware or request handler
        return $next($request);
    }
}
