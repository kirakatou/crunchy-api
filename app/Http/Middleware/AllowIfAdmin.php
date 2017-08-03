<?php

namespace App\Http\Middleware;

use Closure;

class AllowIfAdmin
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
        if ($request->user()->admin_id == null){
            return response()->json(['message' => 'Unauthorized Access'], 401);
        }
        return $next($request);
    }
}
