<?php

namespace Byg\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Byg\Admin\Http\Responses\Api\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (\Auth::check()) {
            $request = app(Request::class);
            if(!$request->ajax()) {
                return redirect()->route('Backend.dashboard.index');
            }
        }
        return $next($request);
    }
}