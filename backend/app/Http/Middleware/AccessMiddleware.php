<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string ...$permissions
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, string ...$permissions)
    {
        if (Gate::denies('access', $permissions)) {
            abort(403);
        }

//        if($permissions == 'Ivan'){
//            abort(403);
//        }

        print_r(date('c'));
        print_r($permissions);
        return $next($request);
    }
}
