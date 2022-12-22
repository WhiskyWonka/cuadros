<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        $header = $request->header('X-HTTP-USER-ID');

        if ($header === "1") {
            return $next($request);
        }

        return response('Acceso denegado', 403);

    }
}
