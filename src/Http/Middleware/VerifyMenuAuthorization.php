<?php

namespace PhpCollective\MenuMaker\Http\Middleware;

use Closure;

class VerifyMenuAuthorization
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
        if ($request->user()->admin() || $request->user()->authorize($request)) {
            return $next($request);
        }

        return abort(401);
    }
}
