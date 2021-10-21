<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param \Illuminate\Http\Response $response
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null){
        $response = $next($request);

        return $response
            ->header("Access-Control-Allow-Origin", "*")
            ->header("Access-Control-Allow-Credentials", true);
    }
}
