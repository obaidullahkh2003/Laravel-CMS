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
    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('admin')->check()) {
            if ($request->is('admin/login') || $request->is('admin/register')) {
                return redirect()->route('home');
            }
        } else {
            if (!$request->is('admin/login') && !$request->is('admin/register')) {
                return redirect()->route('admin.login');
            }
        }

        return $next($request);
    }



}
