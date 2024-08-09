<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        logger('Hello this is Testing-Middleware : '.$request->url());
        $accepted_user = [1,11];
        if (!array_filter(\Auth::id(),$accepted_user)) {
            abort(403);
        }
        return $next($request);
    }
}
