<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsCustomer
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Customer Middleware Access:', [
            'user_id' => Auth::id(),
            'user_role' => Auth::user() ? Auth::user()->role->name : 'No Auth User'
        ]);

        if (!Auth::check() || Auth::user()->role->name !== 'customer') {
            Log::warning('Access Denied for Customer Route:', [
                'user_id' => Auth::id(),
                'required_role' => 'customer'
            ]);
            return redirect('/')->with('error', 'Access Denied');
        }

        return $next($request);
    }
}
