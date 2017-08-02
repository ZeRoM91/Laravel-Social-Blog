<?php

namespace App\Http\Middleware;

use Closure;

class IsAuthor
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

        if($request -> id == Auth::user() -> id) {

            return view('errors.403');
        }
        return $next($request);
    }
}
