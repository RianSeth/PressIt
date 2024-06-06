<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->status === 'banned') {
            // Jika status pengguna adalah 'banned', redirect atau berikan respons yang sesuai
            return redirect()->route('dashboard')->with('error', 'Your account has been banned.');
        }

        return $next($request);
    }
}
