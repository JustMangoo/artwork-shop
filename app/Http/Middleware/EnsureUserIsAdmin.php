<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Admin Middleware Access:', [
            'user_id' => Auth::id(),
            'user_role' => Auth::user() ? Auth::user()->role->name : 'No Auth User'
        ]);

        if (!Auth::check() || Auth::user()->role->name !== 'admin') {
            Log::warning('Access Denied for Admin Route:', [
                'user_id' => Auth::id(),
                'required_role' => 'admin'
            ]);
            return redirect('/')->with('error', 'Access Denied');
        }

        return $next($request);
    }
}
