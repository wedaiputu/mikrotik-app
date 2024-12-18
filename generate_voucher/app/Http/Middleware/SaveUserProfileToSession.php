<?php

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SaveUserProfileToSession
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
        // Check if the user is authenticated
        if (auth()->check()) {
            // Save user profile (name) to session
            session(['profile' => auth()->user()->name]);
        }

        // Proceed with the next middleware
        return $next($request);
    }
}
