<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class Gate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // dd($role);

        $permissions = [
            1 => ['user', 'home'],
            10 => ['user', 'admin', 'home']
        ];

        if ('home' == $role && !FacadesAuth::user()) {
            return redirect('login');
        }

        if (!in_array($role, $permissions[FacadesAuth::user()->role])) {
            abort(401);
        }
        return $next($request);
    }
}
