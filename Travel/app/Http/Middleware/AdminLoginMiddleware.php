<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Account;
use Session;
use App\MemberGroup;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request of user
     * @param \Closure                 $next    request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Session::get('admin');
        if ($user != null) {
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
}
