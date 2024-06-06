<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddUniqueKeyToFlashMessages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $flashTypes = ['message', 'success', 'error', 'warning',];
        $uniqueKey = now()->timestamp;

        foreach ($flashTypes as $type) {
            if ($request->session()->has($type)) {
                $flashMessage = $request->session()->get($type);
                $request->session()->put($type, [
                    'message' => $flashMessage,
                    'uniqueKey' => $uniqueKey,
                ]);
            }
        }

        return $response;
    }
}
