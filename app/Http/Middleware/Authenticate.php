<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            } elseif (Str::startsWith($request->path(), 'enterprise/')) {
                return route('enterprise.login');
            }

            return route('login');
        }
    }
}
