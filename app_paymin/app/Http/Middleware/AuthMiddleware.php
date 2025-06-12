<?php

namespace App\Http\Middleware;

use App\Models\Mdl_Admin;
use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Mdl_Admin::where('role', 'admin')->count() === 0) {
            return redirect()->route('Auth')->with('message', 'admin is empty, please input data.');
        }
        if (!$request->session()->has('user_id')) {
            return redirect()->route('Auth');
        }
        return $next($request);
    }
}