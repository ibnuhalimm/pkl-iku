<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllRoleAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array(Auth::user()->role_id, [ User::ROLE_SUPERUSER, User::ROLE_ADMIN ])) {
            return $next($request);
        }

        abort(Response::HTTP_FORBIDDEN, 'Tidak diizinkan.');
    }
}
