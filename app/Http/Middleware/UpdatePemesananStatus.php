<?php

namespace App\Http\Middleware;

use App\Http\Controllers\LandingController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdatePemesananStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $controller = new LandingController();
        $controller->updatePemesananStatus();

        return $next($request);
    }
}
