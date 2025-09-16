<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_otp_verified')) {
            return redirect()->route('admin.verify');
        }
        return $next($request);
    }
} 