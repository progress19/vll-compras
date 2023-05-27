<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole {
    public function handle(Request $request, Closure $next, $role) {

        //dd($request);
        
        if ( $request->user()->rol === (int)$role ) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
