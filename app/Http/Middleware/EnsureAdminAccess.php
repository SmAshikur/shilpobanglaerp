<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminAccess
{
    /**
     * Only allow admin users. Redirect employees to their own portal.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'employee') {
            return redirect()->route('employee.dashboard')
                ->with('error', 'You do not have permission to access that area.');
        }

        return $next($request);
    }
}
