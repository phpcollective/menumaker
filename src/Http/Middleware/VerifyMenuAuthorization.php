<?php

namespace PhpCollective\MenuMaker\Http\Middleware;

use Closure;

class VerifyMenuAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! config('menu.enabled')
            || is_excluded_route($request->route())
            || is_public_route($request->route())
            || optional($request->user())->admin()
            || optional($request->user())->authorize($request)) {
            return $next($request);
        }

        return unauthorized();
    }
}
