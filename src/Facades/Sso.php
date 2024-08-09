<?php

namespace Sso\SsoSdk\Facades;

use Illuminate\Support\Facades\Facade;
use Sso\SsoSdk\Services\SsoService;

/**
 * @method static bool enabled()
 * @method static array accessToken(string $redirectToken)
 * @method static bool checkPermissions(string $token, string|array $permission, ?string $guard = null)
 * @method static array existDocument(bool $expected)
 */
class Sso extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SsoService::class;
    }
}
