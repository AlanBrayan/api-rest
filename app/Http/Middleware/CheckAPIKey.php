<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');
        $bearerToken = $request->bearerToken();

        if (isset($apiKey) && $apiKey == 'japsapp223mnajask121majsjadskfllfl3272' && isset($bearerToken) && $bearerToken == 'daskdasjkdjkajkdkjasjda23342343') {
            return $next($request);
        }

        return response()->json(['error' => 'API Key no válida o Bearer Token incorrecto'], 401);
    }

}
