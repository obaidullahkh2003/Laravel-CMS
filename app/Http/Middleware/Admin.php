<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method static count()
 */
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()) {
            \Log::debug('Admin is not authenticated.', ['ip' => $request->ip()]);

            return redirect()->route('admin_login')->with('error', 'You are not authorized to access this page.');
        }

        \Log::debug('Admin is authenticated.', ['admin_id' => Auth::guard('admin')->id()]);

        return $next($request);
    }

}
