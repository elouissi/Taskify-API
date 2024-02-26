<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Rediriger vers la route login
        }
    }
    
}
