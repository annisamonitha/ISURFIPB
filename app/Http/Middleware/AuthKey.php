<?php

namespace App\Http\Middleware;

use Closure;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        $token_db = "Bearer " . "KYKlwOM3rIWc6IsEFpMaz5vlaNbDM1di";
        if ($token != $token_db) {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
        return $next($request);
    }
}
