<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class EnsureEmailIsVerified {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $isVerifyEmailRoute = $request->fullUrl() == route('email.request.verification');
        $isVerifiedUser = $request->user() && $request->user()->hasVerifiedEmail();

        if ( !isVerifyEmailRoute && !isVerifiedUser) {
            throw new AuthorizationException('Unauthorized, your email address '.$request->user()->email.' is not verified.');
        }

        return $next($request);
    }
}
