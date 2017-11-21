<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Log;

class Authen {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        Log::debug('inside handle authen middleware');
        if (Auth::check()) {
            return $next($request);
        }
        return redirect('/');
    }

}
