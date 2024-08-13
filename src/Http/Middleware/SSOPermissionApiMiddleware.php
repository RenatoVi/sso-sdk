<?php

namespace Sso\SsoSdk\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Sso\SsoSdk\Exceptions\UnauthorizedException;
use Sso\SsoSdk\Facades\Sso;
use Symfony\Component\HttpFoundation\Response;

class SSOPermissionApiMiddleware
{
    public function handle($request, Closure $next, $permission = null, $guard = null)
    {
        $token = $request->bearerToken();

        if (! $token) {
            throw UnauthorizedException::notLoggedIn();
        }

        if (!Sso::checkPermissions($token, $permission, $guard)) {
            $permissions = is_array($permission) ? $permission : [$permission];
            throw UnauthorizedException::forPermissions();
        }

        return $next($request);
    }
}
