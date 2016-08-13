<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Session;

class AuthCheck
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
        if (!User::getCurrentUser()) {
            Session::set('msg', ['msg' => '还未登录或登录已过期', 'type' => 'error']);
            return redirect('/login');
        }

        return $next($request);
    }
}
