<?php

namespace Sso\SsoSdk\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Sso\SsoSdk\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class SSOPermissionMiddleware
{
    public function handle($request, Closure $next, $permission, $guard = null)
    {

        $authGuard = Auth::guard($guard);

        $user = $authGuard->user();

        if (! $user) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        if (!$token = session()?->get('token')) {
            throw UnauthorizedException::notLoggedIn();
        }

        $response = Http::baseUrl(config('sso.url'))
            ->acceptJson()
            ->withToken($token)
            ->withHeader('partnership', config('sso.partnership'))
            ->post('api/user/check-permissions', [
                'permissions' => $permissions,
                'guard' => $guard,
            ]);

        if ($response->status() !== Response::HTTP_OK) {
            throw UnauthorizedException::forPermissions($permissions);
        }

        return $next($request);
    }
}
