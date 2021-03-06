<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EditProfile
{
    private $auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user exists and it has a role of admin or operator
        $this->auth = auth()->user() ? (
            auth()->user()->role === 'admin' ||
            auth()->user()->role === 'operator'
        )
            : false;
        if ($this->auth)
            // Pass request if auth is valid
            return $next($request);
        // redirect to login with a flash message
        return redirect()->route('login')->with('error', 'Acces denied, login to continue');
    }
}
